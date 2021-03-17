'<a class="list-group-item">
                        <div class="row">
                            <div class="col-4 align-self-center">
                                <div class="row align-self-start"><h5 class="text-uppercase text-danger">'. $list->Kaizen_title .'</h5></div>
                                <div class="row align-self-end">Kaizen Type : '. $list->Kaizen_type .'</div>
                            </div>
                            <div class="col-3">
                                <div class="row">
                                    <div class="col-10 align-self-center">
                                        
                                        <div class="row mb-2">
                                            <div class="col-2">
                                                <i class="fas fa-map-pin"></i>
                                            </div>
                                            <div class="col-8">
                                                '.$list->Kaizen_dept.'
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2">
                                                <i class="fas fa-user"></i>
                                            </div>
                                            <div class="col">'.
                                                foreach($memberlist as $members){
                                                    if($list->Kaizen_ID == $members->Kaizen_ID){
                                                        if($members->member_roles == "Leader"){
                                                            $members->Fullname;
                                                        }
                                                    }
                                                }.'
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 align-self-center">
                                <div class="row mb-2">
                                    <div class="col-2">
                                        <i class="far fa-calendar-alt"></i>
                                    </div>
                                    <div class="col-8">'
                                        foreach($datelist as $date){
                                            if($list->Kaizen_ID == $date->Kaizen_ID){
                                                
                                                    $fdate = $date->Kaizen_DateFrom;
                                                    $tdate = $date->Kaizen_DateTo;

                                                    $datetime1 = new DateTime($fdate);
                                                    $datetime2 = new DateTime($tdate);
                                                    $interval = $datetime1->diff($datetime2);
                                                    $days = $interval->format('%a');
                                                
                                                {{$days+1}}
                                            }
                                        }'
                                        Day(s)
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-2">
                                        <i class="fas fa-info-circle"></i>                 
                                    </div>
                                    <div class="col-10">'
                                        if($list->Kaizen_status == "Waiting"){
                                            '<p>'. $list->Kaizen_status .' <i class="fas fa-exclamation-circle text-warning"></i></p>'
                                        }
                                        else if($list->Kaizen_status == "Completed"){
                                            '<p>'. $list->Kaizen_status .' <i class="fas fa-check-circle text-success"></i></p>'
                                        }
                                        else if($list->Kaizen_status == "Recorded"){
                                            '<p>'. $list->Kaizen_status .' <i class="fas fa-clipboard-list text-primary"></i></p>'
                                        }
                                        else if($list->Kaizen_status == "Approved"){
                                            '<p>'. $list->Kaizen_status .' <i class="far fa-thumbs-up text-primary"></i></p>'
                                        }
                                        else{
                                            '<p>'. $list->Kaizen_status .' <i class="fas fa-times-circle text-danger"></i></p>'
                                        }
                                        
                                    '</div>
                                
                                </div>
                            </div>
                            <div class="col-2 align-self-center">
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#allkz'.$list->Kaizen_ID.'">Details</button>
                            </div>
                        </div>
                    </a>'