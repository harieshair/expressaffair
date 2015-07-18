
            <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title">Yarn Requirements</h3>
                </div>
                
                <div class="box-body">
                <div class="row">
                  <div class="col-md-3"><label>Yarn Count</label>
                    <input type="text" id="yarncount"  placeholder="Yarn Count" class="form-control"/></div>
                  <div class="col-md-3"><label>Color</label>
                        <select class="form-control" id="dd_color">
                          <option>Red</option>
                          <option>Green</option>
                          <option>Blue</option>                       
                        </select>
                  </div>
                  <div class="col-md-3"><label>Kgs</label>
                        <input type="text" id="yarnkgs"  placeholder="pieces" class="form-control"/></div>
                  <div class="col-md-3">
                    <a  href="javascript:void(0);"  class="btn btn-app" onclick="addyarnbriefs();">
                    <i class="fa fa-save"></i>Add
                  </a>
                    </div>
                </div>
              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Order Description</h3>
              </div>                    
                    <table id="yarnrbriefs" width="100%">
                    <thead><tr class="gridHeader"><th width="10%"></th> <th width="30%">Count</th>
                     <th width="15%" >Color</th>
                     <th width="15%" >Kgs</th>
                     <th width="20%"></th></tr></thead>
                    <tbody></tbody>
                    </table>
              </div>

              </div>
            </div>
          