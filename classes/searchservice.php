<?php

class searchservices {

    public $internalDB;

    function searchservices($db) {
        $this->internalDB = $db;
    }

    /* ----------------------------------------------------------------------------- */

    function getServicesBySearchOption($searchObj) {
        $itemArray = array();
        $itemArray = array('Exception' => null, 'Items' => null);
        $selectCount = "SELECT count(vs.id) ";
        $joinclause = " FROM  v_services vs inner join v_service_location vsl on vsl.vservice_id=vs.id ";
        $where = " where vs.service_id is not null ";
        //Location filter	
        $where.=!empty($searchObj->locationId) ? " AND vsl.location_id=$searchObj->locationId " : '';
        //Service filter
        $where.=!empty($searchObj->serviceId) ? " AND vs.service_id=$searchObj->serviceId " : '';
        //Event filter
        if (!empty($searchObj->eventId)) {
            $joinclause.=" inner join e_services es on es.service_id=vs.service_id ";
            $where.=" AND es.event_id=$searchObj->eventId ";
        }
        // Ritual filter
        if (!empty($searchObj->ritualId)) {
            $joinclause.=" inner join r_services rs on rs.service_id=vs.service_id ";
            $where.=" AND rs.ritual_id=$searchObj->ritualId ";
        }
        //Package filter
        if (!empty($searchObj->packages)) {
            $where.=" AND vs.service_category in (" . implode(',', $searchObj->packages) . ") ";
        }
        // Price range filter
        if (!empty($searchObj->priceMinimum) && !empty($searchObj->priceMaximum)) {
            $where.=" AND (vs.price between $searchObj->priceMinimum and $searchObj->priceMaximum) ";
        } else if (empty($searchObj->priceMinimum) && !empty($searchObj->priceMaximum)) {
            $where.=" AND (vs.price <= $searchObj->priceMaximum) ";
        }
        //Customer filter
        if (!empty($searchObj->customerId)) {
            $where.=" AND NOT EXISTS (select c.v_service_id from carts c where c.v_service_id = vs.id and c.customer_id=$searchObj->customerId) ";
        }
        //Limit 
        $searchObj->start = empty($searchObj->start) ? 0 : $searchObj->start;
        $searchObj->max = empty($searchObj->max) ? 15 : $searchObj->max;
        $limit = " limit $searchObj->start, $searchObj->max ";


        $totalItem = $this->internalDB->queryFirstField($selectCount . $joinclause . $where . $limit);

        if ($totalItem > 0) {

            $selectclause = "SELECT vs.id,vsl.location_id as locationId,vs.vendor_id as vendorId,vs.title,vs.price,concat('" . HTTPAPPLICATIONROOT . '/' . "',vs.master_image) as filePath ,vs.service_id as serviceId,vs.review ";
            $orderby = " order by ";
            switch ($searchObj->orderBy) {
                case "1":
                    $orderby.=" vs.review desc ";
                    break;
                case "2":
                    $orderby.=" vs.price desc ";
                    break;
                default:
                    $orderby.=" vs.review desc ";
                    break;
            }

            $items = $this->internalDB->query($selectclause . $joinclause . $where . $orderby . $limit);

            //Get already booked service ids
            $bookedVendorServiceIds = array();
            $bookingbegin = "";
            $bookingend = "";
            if (!empty($searchObj->eventFrom) || !empty($searchObj->eventTo)) {
                $sqlbookedservice = "SELECT vservice_id FROM booking_dates ";
                if (!empty($searchObj->eventFrom)) {
                    $eventfrom = explode('/', $searchObj->eventFrom);
                    $bookingbegin = $eventfrom[2] . '-' . $eventfrom[0] . '-' . $eventfrom[1];
                }

                if (!empty($searchObj->eventTo)) {
                    $eventto = explode('/', $searchObj->eventTo);
                    $bookingend = $eventto[2] . '-' . $eventto[0] . '-' . $eventto[1];
                } else
                    $bookingend = $eventfrom[2] . '-' . $eventfrom[0] . '-' . $eventfrom[1];
                $sqlbookedservice.=" where booking_date between '$bookingbegin' and '$bookingend'";
                $bookedVendorServiceIds = $this->internalDB->queryFirstColumn($sqlbookedservice);
            }
            //Get all city catalogs
            $catalogarray = array();
            $catalogvalues = $this->internalDB->query("SELECT id,catalog_value FROM catalog_value c where catalogmaster_id in (select id from catalog_master where name in ('City'))");
            foreach ($catalogvalues as $catalog)
                $catalogarray[$catalog['id']] = $catalog['catalog_value'];
            for ($i = 0; $i < $totalItem; $i++) {
                $items[$i]['city'] = $catalogarray[$items[$i]['locationId']];
                if (in_array($items[$i]['id'], $bookedVendorServiceIds))
                    $items[$i]['isBooked'] = true;
                else
                    $items[$i]['isBooked'] = false;
            }
            $itemArray['Items'] = $items;
        }
        return $itemArray;
    }
}