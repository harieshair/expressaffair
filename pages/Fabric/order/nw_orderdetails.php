                <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Order Details</h3>
                </div>
                <div class="box-body"> 

                <div class="row">
                  <div class ="col-lg-6">
                    <div class="form-group margin">
                      <label>Order Name:</label>                    
                       <input type="text" id="ordername" class="form-control" placeholder="Order Name"> 
                    </div>
                  </div>
                  <div class ="col-lg-6">
                    <div class="form-group margin">
                      <label>Season:</label>                    
                       <input type="text" id="season" class="form-control" placeholder="Season"> 
                    </div>
                  </div>
                  <div class ="col-lg-6">
                    <div class="form-group margin">
                      <label>Fabric Name:</label>                    
                       <input type="text" id="fabric" class="form-control" placeholder="fabric"> 
                    </div>
                  </div>
                  <div class ="col-lg-6">
                    <div class="form-group margin">
                      <label>Merchandiser:</label>                    
                       <select class="form-control">
                          <option>Prakash</option>
                          <option>Kalai</option>
                          <option>Deiva</option>                       
                        </select>
                    </div>
                  </div>
                  <div class ="col-lg-6">
                    <div class="input-group margin">
                      <label>Quantity:</label>                    
                      <div class="input-group">  
                        <input type="text" id="quantity" class="form-control" placeholder="Quantity">
                        <div class="input-group-btn">
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">In<span class="fa fa-caret-down"></span></button>
                          <ul class="dropdown-menu">
                            <li><a href="#">Kg</a></li>
                            <li><a href="#">pcs</a></li>                        
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>                
                  <div class ="col-lg-6">
                    <div class="form-group margin">
                     <label>GSM</label>                      
                       <input type="text" id="gsm" class="form-control" placeholder="GSM">                      
                    </div>
                  </div>

                  <div class ="col-lg-6">
                     <div class="form-group margin">
                      <label>Excess Percent</label>                    
                      <input type="text" id="excess" class="form-control" placeholder="excess">                                                                        
                      </div>
                    </div>

                    <div class ="col-lg-6">
                      <div class="form-group margin">
                        <label>Customer:</label>                    
                         <select class="form-control">
                            <option>US Polo</option>
                            <option>Nike</option>
                            <option>Lotto</option>                       
                          </select>
                      </div>
                    </div>

                    <div class ="col-lg-6">
                      <div class="form-group">
                        <label>Order Date:</label>
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
                        </div>
                      </div>
                    </div>                  

                   <div class ="col-lg-6">
                     <div class="form-group">
                       <label>Delivery Type:</label>
                      <label class="form-control" >
                        <input type="radio" class="flat-red" name="deliverytype" checked/>
                        Partial                   
                        <input type="radio" class="flat-red" name="deliverytype"/>
                        Complete
                      </label>                    
                    </div>
                    </div>

                    <div class ="col-lg-6">
                      <div class="form-group">
                        <label>Delivery Date:</label>
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> 
              </div>
    