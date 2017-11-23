
            <div class="row">
                <div class="form-group col-lg-4">
                    <label >Room</label>
                    <select class="form-control" name="room" id="room">
                        <?php 
                            while($row = mysqli_fetch_array($roomquery)){
                                
                                echo '<option value="'.$row["roomid"].'"';
                                if ($row["roomid"] == $roomid) {
                                    echo ' selected';
                                }
                                echo '>'.$row["roomname"].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group col-lg-4">
                    <label >Campus</label>
                    <select class="form-control" name="campus" id="campus"<?php if ($_SESSION["role"] != "0") echo 'readonly'?>>
                        <?php 
                            while($row = mysqli_fetch_array($campusquery)){
                                
                                echo '<option value="'.$row["branchid"].'"';
                                if ($row["branchid"] == $branch) {
                                    echo ' selected';
                                }
                                echo '>'.$row["branchname"].'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row"> 
                <div class="form-group col-lg-4 col-md-4">
                    <label >Date</label>
                    <div class='input-group date datepicker'>
                       <input type='text' class="form-control rq" name="date" <?php echo 'value='.$date; ?>/>
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
               </div>
                <div class="form-group col-lg-4">
                    <label >Time from</label>
                    <div class='input-group date' id="timepickerfrom">
                        <input type='text' class="form-control rq" name="time_start" <?php echo 'value="'.$time_start.'"'; ?>/>
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                        </span>
                    </div>
               </div>
                <div class="form-group col-lg-4">
                    <label >Time to</label>
                    <div class='input-group date' id="timepickerto">
                    <input type='text' class="form-control rq" name="time_end" <?php echo 'value="'.$time_end.'"'; ?>/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-4">
                    <label >Repeat</label>
                    <select class="form-control" name="repeat" id="repeat">
                        <option value="0" <?php if($repeat == 0) echo 'selected';?>>Never</option>
                        <option value="1" <?php if($repeat == 1) echo 'selected';?>>Every Day</option>
                        <option value="7" <?php if($repeat == 7) echo 'selected';?>>Every Week</option>
                        <option value="14" <?php if($repeat == 14) echo 'selected';?>>Every Fortnight</option>
                    </select>
                </div>
                <div class="form-group col-lg-4 col-md-4">
                    <label >End Repeat</label>
                    <div class='input-group date datepicker'>
                       <input type='text' class="form-control" name="end_repeat" id="end_repeat" <?php echo 'value="'.$end_repeat.'"'; ?>>
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
               </div>
            </div>
            
            <div class="row">
                <div class="form-group col-lg-4">
                    <label >Faculty</label>
                    <select class="form-control" name="faculty" id="faculty"<?php if ($_SESSION["role"] != "0") echo 'readonly'?>>
                        <?php 
                            while($row = mysqli_fetch_array($facultyquery)){
                                echo '<option value="'.$row["facultyid"].'"';
                                if ($row["facultyid"] == $faculty) {
                                    echo ' selected';
                                }
                                echo '>'.$row["facultyname"].'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-12">
                    <label >Class Name</label>
                    <input type="text" class="form-control rq" id="userid" name="classname" placeholder="Enter class name" <?php if (isset($classname)) {echo 'value="'.$classname.'"';}?>>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-2">
                    <div class="input-group spinner">
                        <label >Enrolments</label>
                        <div class="input-group spinner">
                            <input type="text" class="form-control rq" <?php echo 'value="'.$capacity.'"';?> name="capacity">
                            <div class="input-group-btn-vertical">
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-lg-4">
                    <label >Trainer</label>
                        <select class="form-control rq" name="tutor" id="tutor">
                        <option value="">Select trainer</option>
                        <?php 
                            while($row = mysqli_fetch_array($tutorquery)){
                                echo '<option value="'.$row["login"].'" phone="'.$row["phone"].'" email="'.$row["email"].'"';
                                if(isset($tutor)){
                                    if ($row["login"] == $tutor) {
                                        echo ' selected';
                                    }
                                }
                                echo '>'.$row["first_name"].' '.$row["last_name"].'</option>';
                            }
                        ?>
                    </select>        
                </div>
                <div class="form-group col-lg-4">
                    <label >Contact information</label>
                    <div class="form-inline">
                        <input type="text" class="form-control" id=phone disabled>
                        <input type="text" class="form-control" id=email disabled>
                    </div>
                    
                </div>
            </div>
            
            