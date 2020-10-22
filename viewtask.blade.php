<!DOCTYPE html>
<html>
   @include('layouts.Header')
   <style>
      .center {
      left: 40%;
      position: absolute;
      }
   </style>
   <style type="text/css">
        .red {
            color:red;
        }
</style>
   <body class="hold-transition sidebar-mini" style="background-color:#eee;">
      @include('layouts.Navigation')
      <div class="content-wrapper">
      <!-- <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
                  <h1>Task Details</h1>
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="#">Home</a></li>
                     <li class="breadcrumb-item active">Task Details</li>
                  </ol>
               </div>
            </div>
         </div>
      </section> -->
      @if (\Session::has('message'))
               <div class="alert alert-success">
                  <ul>
                     <li>{!! \Session::get('message') !!}</li>
                  </ul>
               </div>
               @endif
      <section class="content">
         <div class="container-fluid">
         <div class="row">
            <div class="col-md-11"> 
               <!-- @if (\Session::has('message'))
               <div class="alert alert-success">
                  <ul>
                     <li>{!! \Session::get('message') !!}</li>
                  </ul>
               </div>
               @endif -->
               <div class="card cards1 card-primary mm-4">
               <div class="card-header card-header-icon cardsheadre" data-background-color="rose" style=" ">
                                <i class="fa fa-tasks cardicons" style=""></i>
                            </div>
                                <h4 class="card-title" style="float: left;margin-top: -3%; margin-left: 10%;">{{$taskdata->isactive ==0 ? 'In-Active Task' : 'Active Task'}}</h4>
                 
                  <form class="form-horizontal" action="TaskRegister" method='post' autocomplete='off'>
                     {{ csrf_field() }}
                     <div class="card-body">
                        <div class = "form-row" >
                           <div class="form-group col-md-6 {{ $errors->has('taskid') ? 'has-error' : '' }}">
                              <label for="taskid" class="col-sm-12 col-form-label">Task Name</label>
                              <div class="col-sm-12">
                                 <select type="dropdown" class="form-control" id="taskid" value="{{$taskdata->task_name}}" name='taskid' onchange="fillProductAndOrganizationData()" disabled="">
                                    <option id="taskid" value="{{$taskmasterrow->task_id}}">{{$taskmasterrow -> task_name}}</option>
                                 </select>
                                 <span class="text-danger">{{ $errors->first('taskid') }}</span>
                              </div>
                           </div>
                           <div class="form-group col-md-6 {{ $errors->has('productname') ? 'has-error' : '' }}">
                              <label for="pid" class="col-sm-12 col-form-label">Product Category</label>
                              <div class="col-sm-12">
                                 <input type="text" class="form-control" id="productname" name = "productname" value="{{ $productrow->product_name }}" readonly value="">
                                 <input type="hidden" name="productId" id="productCategoryId" value="{{ $productrow->product_category }}">
                                 <span class="text-danger">{{ $errors->first('productname') }}</span>
                              </div>
                           </div>
                        </div>
                        <div class="form-row">
                           <div class="form-group col-md-6 {{ $errors->has('companyname') ? 'has-error' : '' }}">
                              <label for="oid" class="col-sm-12 col-form-label">Insurance Company</label>
                              <div class="col-sm-12">
                                 <input class="form-control" type="text" id="companyname" name = "companyname" readonly value="{{$companyrow->company_name}}"  >
                                 <input type="hidden" name="companyId" id="companyId" value="">
                                 <span class="text-danger">{{ $errors->first('companyname') }}</span>
                              </div>
                           </div>
                           <div class="form-group col-md-6 {{ $errors->has('planid') ? 'has-error' : '' }}">
                              <label for="planid" class="col-sm-12 col-form-label">Plan Name</label>
                              <div class="col-sm-12">
                                 <select type="dropdown" class="form-control" id="planid" value="{{$planrow->plan_name}}" name='planid' disabled="">
                                    <option id="planid" name="planname" value="{{$planrow->plan_id}}">{{$planrow -> plan_name}}</option>
                                 </select>
                                 <span class="text-danger">{{ $errors->first('planid') }}</span>
                              </div>
                           </div>
                        </div>
                        @if($rolename=='Project manager' && App\Utilities\UtilClass::getRoleName($taskdata->createdby)=="Project manager" )
                        <div class="form-group {{ $errors->has('organizationid') ? 'has-error' : '' }}">
                           <label for="oid" class="col-sm-12 col-form-label">Organization</label>
                           <div class="col-sm-12">
                              <input class="form-control" type="text" id=organizationname" name = "organizationname" readonly value="{{$organizationrow->organization_name ?? ''}}">
                              <input type="hidden" name="organizationId" id="organizationId" value="{{$organizationrow->organization_id ?? ''}}">
                              <span class="text-danger">{{ $errors->first('oid') }}</span>
                           </div>
                        </div>
                        @endif
                        <div class="form-row">
                           <div class="form-group col-md-6 {{ $errors->has('channelid') ? 'has-error' : 'cid' }}" style="">
                              <label for="channelid" class="col-sm-6 col-form-label">Channel Type:</label>
                              <div class="clearfix"></div>  
                              <div class="col-sm-6 m22">
                                 <input type="checkbox" id="channelid"  name='channelid' disabled="" {{strstr($taskdata->channel_id,"1") ? "checked" : ""}}>
                                 <label class="checkbox-inline">POS</label>&nbsp&nbsp&nbsp&nbsp
                                 <input type="checkbox" id="channelid"  name='channelid' disabled="" {{strstr($taskdata->channel_id,"2") ? "checked" : ""}} >
                                 <label class="checkbox-inline">NON-POS</label>
                                 <span class="text-danger">{{ $errors->first('channelid') }}</span>
                              </div>
                           </div>
                           <div class="form-group col-md-6 {{ $errors->has('integrationid') ? 'has-error' : 'integrationid' }}">
                                 <label id="integrationlabel" class="col-md-6  col-form-label">Integration Type:</label>
                                 <div class="clearfix"></div>   
                                 <div style="" id="healthIntegrations">
                                    <input type="checkbox" id="integrationid"  name='integrationid' disabled="" {{strstr($taskdata->integration_type_id,"1") ? "checked" : ""}}>
                                    <label class="checkbox-inline">STP</label>&nbsp&nbsp&nbsp&nbsp
                                    <input type="checkbox" id="integrationid"  name='integrationid' disabled="" {{strstr($taskdata->integration_type_id,"2") ? "checked" : ""}} >
                                    <label class="checkbox-inline">NSTP</label>&nbsp&nbsp&nbsp&nbsp
                                    </div>
                                    <div style="display:none" id="motorIntegrations">
                                    <input type="checkbox" id="integrationid"  name='integrationid' disabled="" {{strstr($taskdata->integration_type_id,"3") ? "checked" : ""}}>
                                    <label class="checkbox-inline">New & Rollover</label>&nbsp&nbsp&nbsp&nbsp
                                    <input type="checkbox" id="integrationid"  name='integrationid' disabled="" {{strstr($taskdata->integration_type_id,"4") ? "checked" : ""}}>
                                    <label class="checkbox-inline">SAOD</label>
                                    <input type="checkbox" id="integrationid"  name='integrationid' disabled="" {{strstr($taskdata->integration_type_id,"5") ? "checked" : ""}}>
                                    <label class="checkbox-inline">SATP</label>
                                    <input type="checkbox" id="integrationid"  name='integrationid' disabled="" {{strstr($taskdata->integration_type_id,"6") ? "checked" : ""}}>
                                    <label class="checkbox-inline">Break In</label>
                                    </div>
                                    <div style="display:none" id="homeIntegrations">
                                    <input type="checkbox" id="integrationid"  name='integrationid' disabled="" {{strstr($taskdata->integration_type_id,"7") ? "checked" : ""}}>
                                    <label class="checkbox-inline">Structure</label>&nbsp&nbsp&nbsp&nbsp
                                    <input type="checkbox" id="integrationid"  name='integrationid' disabled="" {{strstr($taskdata->integration_type_id,"8") ? "checked" : ""}}>
                                    <label class="checkbox-inline">Content</label>
                                    </div>
                                    <span class="text-danger">{{ $errors->first('integration id') }}</span>
                              </div>
                              </div>
                           <div class="form-row">
                              <div class="form-group col-sm-6{{ $errors->has('kitrec') ? 'has-error' : '' }}">
                                 <label for="kit" class="col-md-6 col-form-label">Kit Received by Fyntune:</label>
                                 <div class="clearfix"></div>
                                 <span class="" style="height:50px";>
                                    <div style="display: inline;">
                                       <input type='radio' id="yes" name='kitrec' value="1" disabled="" {{$taskdata->is_kit_received == 1? 'checked' : "" }}/>
                                       <label>Yes</label>
                                       <input type='radio' id="no" name='kitrec' value="0" disabled="" {{$taskdata->is_kit_received == 0 ? 'checked':'' }}/>
                                       <label>No</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                       <span class="text-danger">{{ $errors->first('kitrec') }}</span>
                                    </div>
                                 </span>
                              </div>
                              <div class="form-group col-sm-6{{ $errors->has('C_rec') ? 'has-error' : '' }}">
                                 <label for="kit" class="col-form-label ml1">Credentials Received by Fyntune:</label>
                                 <div class="clearfix"></div>
                                 <span class="" style="height:50px";>
                                    <div style="display: inline;">
                                       <input type='radio' id="yes" name='C_rec' value=1 disabled=""
                                       {{$taskdata->is_credential_recieved == 1 ? 'checked' : "" }}/>
                                       <label>Yes</label>
                                       <input type='radio' id="no" name='C_rec' value=0 disabled=""
                                       {{$taskdata->is_credential_recieved == 0 ? "checked":'' }}/>
                                       <label>No</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                       <span class="text-danger">{{ $errors->first('Credentials Recieved') }}</span>
                                    </div>
                                 </span>
                              </div> 
                           </div>
                        </div>
                       
                        <!-- closing of radio button wrapper -->
                        <div class="card-body cardbody form-group col-md-12{{ $errors->has('Desc') ? 'has-error' : '' }}">
                           <label for="Desc" class="col-sm-12 col-form-label">Task Description</label>
                           <div class="col-sm-12">
                              <textarea type="text" class="form-control" id="Desc" value="{{$taskdata->task_description}}" name='Desc' placeholder="Description" readonly="">{{$taskdata->task_description}}</textarea>
                              <span class="text-danger">{{ $errors->first('Desc') }}</span>
                           </div>
                           <div class="clearfix"><br/></div>
                           <div class="form-row">
                              <div class="form-group col-md-6{{ $errors->has('broker') ? 'has-error' : '' }}">
                                 <label for="broker" class="col-sm-12 col-form-label">Broker spoc</label>
                                 <div class="col-sm-12">
                                    <input type='text' class="form-control" id="broker" name='broker' value="{{$managername}}" placeholder="Broker" readonly="" />
                                 </div>
                                 <span class="text-danger">{{ $errors->first('broker') }}</span>
                              </div>
                              <div class="form-group col-md-6{{ $errors->has('taskcreatedon') ? 'has-error' : '' }}">
                                 <label for="taskcreatedon" class="col-sm-12 col-form-label">Task Created On</label>
                                 <div class="col-sm-12">
                                    <input type='text' class="form-control" date-date-format='DD MM YYYY' id="taskcreatedon" name='taskcreatedon' value="{{$taskdata->createdon->format('d/m/Y')}}" disabled/>
                                 </div>
                                 <span class="text-danger">{{ $errors->first('taskcreatedon') }}</span>
                              </div>
                           </div>
                        </div>

                        @if(!$documentdata->isEmpty())
                        <div class="form_row dflex mbottom col-md-12">
                        <div class="form-group col-md-6" style="height:50%">
                           <label for="document" class="col-sm-12 col-form-label">Document uploaded by broker</label>
                           @foreach($documentdata as $data)
                           <button type="button" class="form-control" {{--onclick='showFile("{{Storage::url($data->document_name)}}")'--}} > {{$data->document_path}} </button>
                           @endforeach
                        </div>

                        <div class="form-group col-md-6" style="height:50%">
                           <label for="document" class="col-sm-12 col-form-label">Document Type</label>
                           <input type='text' class="form-control" id="documenttype" name='documenttype' value="{{$data->document_type}}" disabled/>    
                        </div>
                        </div>
                        @endif
                        <div class="card-body cardbody form-row m52" style="">
                           @if($taskdata->estimated_cost != NULL && $taskdata->estimated_work_hour != NULL)
                           @if(($rolename == "Project manager" && $taskdata->task_stage_id >= 3 ||$rolename == "Project manager" && $taskdata->recreated) || ($rolename == "Broker" && $taskdata->task_stage_id >= 4 || $rolename == "Project manager" && $taskdata->recreated))
                           <div class="card-body cardbody col-md-6{{ $errors->has('estimatedcost') ? 'has-error' : '' }}">
                              <label for="estimatedcost" class="col-sm-12 col-form-label">Estimated Cost</label>
                              <div class="col-sm-12">
                                 <input type='text' class="form-control" id="estimatedcost" name='estimatedcost' value="{{$taskdata->estimated_cost}}" disabled/>
                              </div>
                              <span class="text-danger">{{ $errors->first('estimatedcost') }}</span>
                           </div>
                           <div class="card-body cardbody col-md-6{{ $errors->has('estimatedworkhour') ? 'has-error' : '' }}">
                              <label for="estimatedworkhour" class="col-sm-12 col-form-label">Estimated Work Hour</label>
                              <div class="col-sm-12">
                                 <input type='text' class="form-control" id="estimatedworkhour" name='estimatedworkhour' value="{{$taskdata->estimated_work_hour}}" disabled/>
                              </div>
                              <span class="text-danger">{{ $errors->first('estimatedworkhour') }}</span>
                           </div>
                        </div>
                        @endif
                        @endif                    
                    
                     <div class="card-body cardbody form-group mms2">
                     @if($rolename == "Project manager")
                        <div class="">
                           <!-- Approve Button will be visible when task is new or task is approved by Broker-->
                           
                           @if($taskdata->task_stage_id == 3)
                           @if($taskdata->createdby == Auth::id())
                          <div class="dflex"> <div class=" col-sm-6">
                          <label for="" class="col-sm-12 col-form-label">Select Broker</label>
                              <select id="brokerdropdown" class="form-control">
                                 <option value="0">---select---</option>
                                 @foreach($brokername as $broker)
                                 <option value="{{$broker->user_id}}">{{$broker->user_fname}}</option>
                                 @endforeach
                              </select></div>
                           <div class="col-md-6">  <label><br/></label> <button type="button" class="mm9 btn btn-primary btns float-left widthauto" onclick="forwardToBroker({{$taskdata->task_detail_id}})">Forward Task</button>
                              </div></div>
                              
                           @endif
                           @elseif(($taskdata->status_id == 5 || $taskdata->status_id == 4) && $taskdata->task_stage_id != 9)
                           <a href="{{url('/taskcomplete/'.$taskdata->task_detail_id)}}" type="submit" name ="taskcomplete" class="btn btn-outline-info btns widthauto sendtask">Send completed task to broker</a>
                           @elseif( $taskdata->cost_remark != NULL)
                           <div class="col-md-12">
                              <label for="costremark" class="col-sm-12 col-form-label">Remark from Broker</label>
                                 <div class="form-group">
                                    <textarea type="text" class="form-control" id="costremark" value="{{$taskdata->cost_remark}}" name='costremark' readonly>{{$taskdata->cost_remark}}</textarea>
                                 </div>
                           </div>
                           @if($taskdata->task_stage_id == 6)
                           <a href="{{url('/recreate/'.$taskmasterrow->task_id.'/'.$taskdata->createdby)}}" type="submit" name="Recreate" class="btn btn-outline-primary">Recreate Task</a>
                           @endif
                           @endif
                        </div>
                     </div> </div>
                     @endif
                     </form>
                     <form action="{{route('brokeraction',$taskdata->task_detail_id)}}" method="POST" onsubmit="return validateForm()">
                     @csrf   
                     @if($rolename == "Broker")	
                     @if($taskdata->estimated_cost != NULL && $taskdata->task_stage_id == 4)	
                     <div class="form-group " style="width:100%">
                        <div class = "form-group col-md-12">
                           <label class="form-group">Approve/Reject Cost<span class="required">*</span></label>	
                           <div class="" style="">
                              <select id="costdropdown" onchange="submitApproveOrRejectCost()" name="brokeraction" class="form-control col-sm-12">
                                 <option value="0">---select---</option>
                                 <option value="1">Approve Cost</option>
                                 <option value="2">Reject Cost</option>
                              </select>
                              </div>
                              <span id="dropdownError" style="display:none">PLease select Approve/Reject cost !</span>	

                              <div style="display:none" class="" id="remarkBlock">
                              <label for="remark" class="col-sm-6 col-form-label">Remark<span class="required">*</span></label>	
                              <div class="form-row"><div class="col-md-10">	
                                 <textarea type="text" class="form-control" id="rejectremark" name="costremark" value="{{ old('costremark') }}" placeholder="Remark"></textarea>	
                                 <span class="text-danger col-sm-6">{{ $errors->first('remark') }}</span>
                                 <span id="textareaError" style="display:none;color:red">PLease Enter Remark !</span>	
                              </div>
                              <div class="col-md-1 m-left23"><button  type="submit" name="allocate" id="appRejectButton" class="btns btn btn-success">Submit</button>	</div>
                           </div></div>
                           </div>
                        </div>
                        </div>
                     </div>
                        @endif
                        @endif
                        </form>
                        <div class="">
                        <form action = "{{url('/headapprove',[$taskdata->task_id])}}" method = "post" class="padding-bottom mm-5 col-md-12 float-right whitebg" onsubmit= "return validateApproval()">
                           @csrf   
                           @switch($rolename)
                           @case("Business head")
                           @if($is_business_task == "yes")
                          <div class="mm1-1"  style="">
                           <div class ="taskleft">
                              <div class="form-group col-md-6 ">
                                 <label for="action">Task action</label>
                                 <select type="dropdown" class="form-control " id = "t_action" name = "select_task_action">
                                    <option value="select_action">--Action--</option>
                                    <option value="approve">Approve </option>
                                    <option value="reject">Reject</option>
                                 </select>
                              </div>
                           
                           
                           <div class="col-md-12 m05" id = "t_form" style="display:flex!important;">
                              <div class="form-group col-6">
                                 <label class="required">Estimated cost</label>
                                 <input type="number" name="estcost" class="form-control" id ="estcost" >  
                                 <span class="text-danger" id="errormessagecost"></span>  
                                 @if ($errors->has('estcost')) 
                                 <p style="color:red;">{{ $errors->first('estcost') }}</p>
                                 @endif                              
                              </div>
                              <div class="form-group col-6">
                                 <label class="required">Estimated work hours</label>
                                 <input type="number" name="ehours" class="form-control" id ="esthour">   
                                 <span class="text-danger" id="errormessagehour"></span> 
                                 @if ($errors->has('ehours')) 
                                 <p style="color:red;">{{ $errors->first('ehours') }}</p>
                                 @endif                              
                              </div>
                           </div>
                           <div class="col-md-12"> 
                              <div class="form-row" id = "r_form" style="">
                              <div class="form-group col-6">
                                 <label class="required">Remark</label> 
                                 <input type="textarea" name="taskremark" class="form-control" id ="tremark" >   
                                 <span class="text-danger" id="errormessageremark"></span>
                                 @if ($errors->has('taskremark')) 
                                 <p style="color:red;">{{ $errors->first('taskremark') }}</p>
                                 @endif                              
                              </div></div>
                           </div>
                           </div>
                           </div>
                           <button class="btn btn-success btns btnssubmit" type="submit" id ="bhsubmit" style="margin-left: 66%;
    margin-top: 1%;">Submit</button>
                           <!-- <a href="{{url('/headapprove',[$taskdata->task_id])}}" style="color:white;width:auto;margin:0 auto;"><button class="btn btn-success center" >Submit</button></a>&nbsp;&nbsp;                                          -->
                           <!-- <a href="{{url('/headapprove',[$taskdata->task_id])}}" style="color:white;"><button class="btn btn-success">Approve</button></a>&nbsp;&nbsp;
                              <a href="{{url('/')}}" style="color:white;"><button class="btn btn-danger">Reject</button> </a> -->
                           @endif
                           @break
                           @endswitch

                           <div class="card-footer msrn" style="background-color:#fff;text-align:right">
                           @if($rolename == "Project manager")
                           <!-- Approve Button will be visible when task is new or task is approved by Broker-->
                           @if($taskdata->task_stage_id == 1 || $taskdata->task_stage_id == 5) 
                           <a href="{{url('/addallocation/'.$taskmasterrow->task_id)}}" type="submit" name="allocate" class="btn btn-outline-primary btns">{{$taskdata->task_stage_id == 1 ? "Allocate" : "Allocate"}}</a>
                           @elseif($taskdata->task_stage_id == 3)
                              @if(App\Utilities\UtilClass::getRoleName($taskdata->createdby) == "Broker")
                           <a href="{{url('forwardtobroker/'.$taskdata->task_detail_id.'/'.$taskdata->createdby)}}" type="submit" name ="forwardcost" class="btn btn-outline-info btns widthauto" >Forward to Broker</a>
                              @endif
                           @endif
                           @endif
                           {{--<button  type="submit" name="allocate" class="btn btn-success btns" style="margin-right: 8px;">Submit11</button>	--}}
                           @if($taskdata->task_stage_id <= 2)
                           @if($rolename != 'Business head' && $taskdata->task_stage_id != '6' && $rolename != 'Broker business head' && $rolename != 'Developer')
                              <a href="{{url('edittask',[$taskdata->task_id])}}" type="submit" class="btn btn-warning btn-sm btns" name='submit' style="padding:8px;">Edit</a>
                           @endif
                           @endif
                           @if($rolename == 'Broker' && $taskdata->task_stage_id == '6')
                           <a href="{{url('/recreate/'.$taskmasterrow->task_id.'/'.$taskdata->createdby)}}" type="submit" name="Recreate" class="btn btn-warning">Recreate Task</a>
                           @endif
                              <a href ="{{url('/')}}" type="submit" class="btn btn-info btns">Back</a>
                           </div> 
                     
                 </form>
                        </div>                    
                      
           
                     </div>
            </div></div>
            <div class="clearfix"></div>
            <div class="" style="width:100%;">
               <div class="">
                  <div class="card mm-4">
                  <div class="card-header card-header-icon cardsheadre" data-background-color="rose" style=" ">
                                <i class="fa fa-tasks cardicons" style=""></i>
                            </div>
                                <h4 class="card-title" style="float: left;margin-top: -3%; margin-left: 10%;">Allocation History</h4>
                     <br/>
                     <div class="card-body table-responsive p-0" style="height: 300px;">
                        <table class="table table-head-fixed text-nowrap">
                           <thead>
                              <tr>
                                 <th>From</th>
                                 <th>To</th>
                                 <th>Remark</th>
                                 <th>Allocation Date</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach($dataa as $dat)
                              <tr>
                                 <td>{{ $dat->by_user }} {{ $dat->by_user_lname }}</td>
                                 <td>{{ $dat->to_user }} {{ $dat->to_user_lname }}</td>
                                 <td>{{ $dat->remark }}</td>
                                 <td>{{ $dat->allodate }}</td>
                              </tr>
                              @endforeach
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
      </section>
      </div>
      @include('layouts.Footer')
      <script type="text/javascript"> 

function validateApproval()
{
   if(document.getElementById('t_action').value == "approve")
   {
      let cost = document.getElementById('estcost').value;
      let hour = document.getElementById('esthour').value;
      if(cost == "")
      {
         document.getElementById('errormessagecost').innerHTML = "Please enter estimated cost";
         return false;
      }
      else if(hour == "")
      {
         document.getElementById('errormessagehour').innerHTML = "Please enter estimated hour";
         return false;
      }
      let remarks = document.getElementById('tremark').value;
       if(remarks == "")
       {
          document.getElementById('errormessageremark').innerHTML = "Please enter remark";
          return false;
       }
   }
   else if(document.getElementById('t_action').value == "reject")
   {
      let remark = document.getElementById('tremark').value;
      if(remark == "")
      {
         document.getElementById('errormessageremark').innerHTML = "Please enter remark";
         return false;
      }
   }    
}
</script>
   </body>
   <script>
      function submitApproveOrRejectCost(){	
          var remarkBlock = document.getElementById("remarkBlock");
          var select = document.getElementById("costdropdown").value;	
          	
          if(select == 0)	{
            remarkBlock.style.display = "none";  
          }	
          
          else	
          remarkBlock.style.display = "block";	
          	
      }

      function validateForm(){
         let a   = document.getElementById('rejectremark').value;
         console.log(a);
        if( !document.getElementById('rejectremark').value ){
           document.getElementById('textareaError').style.display = "block";
           return false;
        }
      }	
     
      
      function showFile(filePath){
          console.log(filePath);
          var parent = document.getElementById('filePreview')
          var tag = document.createElement("iframe");
          tag.src = filePath;
          tag.name = "2";
          tag.classList.add("embed-responsive-item");
          parent.innerHTML = "";
          parent.appendChild(tag);
          console.log(filePath);
      }
      
      
   </script>
   <script type="text/javascript">
      $(document).ready(function () {

      $('#t_form').css('display','none');
      $('#r_form').css('display','none');
      $('#bhsubmit').prop('disabled',true);

     
      $(function () {
      
              $("#t_action").change(function () {
                  
              if ($(this).val() == "approve") {
                  $("#t_form").show();
                  $("#r_form").show(); 
                  $('#bhsubmit').prop('disabled',false);
              } else {
                  $("#t_form").hide();
                  $("#r_form").show();
                  $('#bhsubmit').prop('disabled',false);
              }
             
          });
      });
      });

     let productCategoryName =  document.getElementById('productCategoryId').value;
console.log(productCategoryName);
        switch(productCategoryName){
           case  "Motor":
            document.getElementById('integrationlabel').style.display = "block";
           document.getElementById('motorIntegrations').style.display = "block";
           document.getElementById('healthIntegrations').style.display = "none";
           document.getElementById('homeIntegrations').style.display = "none";
           break;
           case "Health":
            document.getElementById('integrationlabel').style.display = "block";
           document.getElementById('motorIntegrations').style.display = "none";
           document.getElementById('healthIntegrations').style.display = "inline";
           document.getElementById('homeIntegrations').style.display = "none";
            break;
           case "Home":
            document.getElementById('integrationlabel').style.display = "block";
           document.getElementById('motorIntegrations').style.display = "none";
           document.getElementById('healthIntegrations').style.display = "none";
           document.getElementById('homeIntegrations').style.display = "block";
           break;
         case "Life":
         case "Others":
            document.getElementById('integrationlabel').style.display = "none";
            document.getElementById('motorIntegrations').style.display = "none";
            document.getElementById('healthIntegrations').style.display = "none";
            document.getElementById('homeIntegrations').style.display = "none";
        }

        function forwardToBroker(taskDetailId){
           let brokerId = document.getElementById('brokerdropdown').value;
           window.location.href = '{{url('forwardtobroker/')}}/'+taskDetailId+'/'+brokerId;
        }
   </script>

   <!-- <script type="text/javascript">  
   function validatemenu(){
    $('#t_action').change(function(){
      var action =  document.getElementById('t_action').value;
      let cost = document.getElementById('estcost').value;
      let hour = document.getElementById('esthour').value;
      let tremark = document.getElementById('tremark').value;
    
    if(action == "approve")
    {    
      if(cost == "" && hour == "" || tremark == "")
      {
          document.getElementById('errormessage').innerHTML = "Please fill estimated cost and hours";
          return false;
      }
    }
    else if(action == "reject")
    {
      if(tremark == "")
      {
          document.getElementById('errormessage').innerHTML = "Please enter remark";
          return false;
      }
    }    
  
  });
}-->
</script>
<script>
$(document).ready(function(){
    $(".required").after("<span class='red'>*</span>");;
});
</script>
</html>