<?php

$i=1;
            // style="display:None;"
            foreach($totalF as $name => $id) {
                $fpoint = 0;
                echo'
            <div class="col-lg m-2 p-2 shadow p-3 mb-1 bg-body rounded border border border-light" id="pdf'.$id.'" style="display:none;">
            
            
            ';
                    $sql = "SELECT * FROM Profile WHERE id='".$id."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="imgcl" style="text-align: center;width: 100%;"> 
                        <img src="../../assets/img/report1.jpg" height="150" style="width:100%;object-fit: contain;" /> 
                        </div>
                        <h5 style="text-align: center;"><b>FOR THE ACADEMIC YEAR:<span style="color: red;">'.date('Y', time() - 60*60*24*365 ).'-'.date("Y").' (July '.date('Y', time() - 60*60*24*365 ).' - July '.date("Y").'), Odd and Even Semester</span></b></h5>
                        <h5 style="text-align: center;text-decoration: underline;"><b>Calculation of Credit Points</b></h5>
                        <h5  style="text-align: right;margin-right: 5rem;"><b>Date:<span  style="text-decoration: underline;">'.date("Y-m-d").'</span></b></h5>
                        <br/>
                        <br/>

                        <table style="border: 1px solid black;width: 100%;padding: .5rem;">
                            <tr>
                            <td style="border: 1px solid black;padding: .5rem;white-space: nowrap;width: 1%;"><b>Full Name</b></td>
                            <td style="border: 1px solid black;padding: .5rem;white-space: nowrap;width: 1%;" colspan="3">'.$row['name'].'</td>
                            </tr>
                            <tr>
                            <td style="border: 1px solid black;padding: .5rem;white-space: nowrap;width: 1%;"><b>Department</b></td>
                            <td style="border: 1px solid black;padding: .5rem;white-space: nowrap;width: 1%;">'.$row['dept'].'</td>
                            <td style="border: 1px solid black;padding: .5rem;white-space: nowrap;width: 1%;"><b>Designation</b></td>
                            <td style="border: 1px solid black;padding: .5rem;white-space: nowrap;width: 1%;">'.$row['role'].'</td>
                            </tr>
                            <tr>
                            <td style="border: 1px solid black;padding: .5rem;white-space: nowrap;width: 1%;"><b>Qualification</b></td>
                            <td style="border: 1px solid black;padding: .5rem;white-space: nowrap;width: 1%;"></td>
                            <td style="border: 1px solid black;padding: .5rem;white-space: nowrap;width: 1%;"><b>Contact No.</b></td>
                            <td style="border: 1px solid black;padding: .5rem;white-space: nowrap;width: 1%;"></td>
                            </tr>
                            <tr>
                            <td style="border: 1px solid black;padding: .5rem;white-space: nowrap;width: 1%;"><b>Email</b></td>
                            <td style="border: 1px solid black;padding: .5rem;white-space: nowrap;width: 1%;" colspan="3">'.$row['id'].'</td>
                            </tr>

                            <!-- TLP -->

                            <tr>
                            <td style="border: 1px solid black;padding: .5rem;width: 1%;padding-top: 2rem;" colspan="4"><h5><b>Teaching Learning Process (Max 50 Points)</b></h5>Class Room / Online Teaching (Max 50 Points)<br/>No. of Lectures Taught with considering 10% Minimum presence in the class, No. of Lect. Scheduled base on teaching weeks as per GTU academic calendar. (Ex: For three lect. Scheme 03 X no. of week per semester )</td>
                            </tr>

                            <tr>
                            <td colspan="4">
                            <table style="border: 1px solid black;width: 100%;padding: .5rem;">
                            <tr>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Sr. No</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Semester</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Subject Code</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Subject Name</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">No of Scheduled Classes</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">No of Actually Classes</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Points Earned</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Verified Name</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Verified ID</th>
                            </tr>
                            ';



                            $i=1;$point=0;
                            $sql = "SELECT * FROM TLP WHERE id='".$id."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    if($row["verify"]==1){
                                        echo'    
                                        <tr>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$i.'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['sem'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['subject'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['name'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['scheduleClass'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['actualClass'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">('.$row['actualClass'].'/'.$row['scheduleClass'].')*50='.$row['point'].'</td>
                                            ';
                                        $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                                        $result2 = mysqli_query($conn, $sql2);
                                        if (mysqli_num_rows($result2) > 0) {
                                            while($row2 = mysqli_fetch_assoc($result2)) {
                                                echo'<td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row2['name'].'</td>';
                                            }
                                        }
                                        echo'
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['vid'].'</td>
                                        </tr>
                                        ';
                                        $i=$i+1;
                                        $point=$point+$row['point'];
                                    }
                                }
                                
                            }
                            $epoint=$point;
                            if($i==1){echo'<tr><td colspan="9" style="border: 1px solid black;padding: .5rem;width: 1%;">NO ENTRY</td></tr>';}
                            if($point>50){$point=50;}
                            $fpoint=$fpoint+$point;





                            echo'
                            <tr><td colspan="9" style="border: 1px solid black;padding: .5rem;width: 1%;text-align: center;"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                            </table>
                            </td>
                            </tr>

                            <!-- GR -->

                            <tr>
                            <td style="border: 1px solid black;padding: .5rem;width: 1%;padding-top: 2rem;" colspan="4"><h5><b>GTU Result (Max 100 Points)</b></h5>Subject wise Difference During the Academic year with GTU results</td>
                            </tr>
                            <tr>
                            <td colspan="4">
                            <table style="border: 1px solid black;width: 100%;padding: .5rem;">
                            <tr>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Sr. No</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Semester</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Subject Code</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Subject Name</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Year</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Result Of Institute</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Result Of GTU</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Points Earned</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Verified Name</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Verified ID</th>
                            </tr>
                            ';

                            $i=1;$point=0;
                            $sql = "SELECT * FROM GR WHERE id='".$id."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    if($row["verify"]==1){
                                        echo'    
                                        <tr>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$i.'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['sem'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['subject'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['subjectName'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['year'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['resultInstitute'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['resultGtu'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['point'].'</td>
                                        ';
                                        $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                                        $result2 = mysqli_query($conn, $sql2);
                                        if (mysqli_num_rows($result2) > 0) {
                                            while($row2 = mysqli_fetch_assoc($result2)) {
                                                echo'<td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row2['name'].'</td>';
                                            }
                                        }
                                        echo'
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['vid'].'</td>
                                        </tr>
                                        ';
                                        $i=$i+1;
                                        $point=$point+$row['point'];
                                    }
                                }
                                
                            }
                            $epoint=$point;
                            if($i==1){echo'<tr><td colspan="10" style="border: 1px solid black;padding: .5rem;width: 1%;text-align: center;">NO ENTRY</td></tr>';}
                            if($point>100){$point=100;}
                            $fpoint=$fpoint+$point;




                            echo'
                            <tr><td colspan="10" style="border: 1px solid black;padding: .5rem;width: 1%;text-align: center;"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                            </table>
                            </td>
                            </tr>

                            <!-- DISC -->

                            <tr>
                            <td style="border: 1px solid black;padding: .5rem;width: 1%;padding-top: 2rem;" colspan="4"><h5><b>Discipline (Max 35 Points)</b></h5></td>
                            </tr>
                            <tr>
                            <td style="border: 1px solid black;padding: .5rem;width: 1%;" colspan="4"><b>Late Punch (Biometric Attendance) (5)</b><br/>0 Nos. = 5, 1 Nos. = 4, 2 Nos. = 3, 3 Nos. =< 0</td>
                            </tr>
                            <tr>
                            <td style="border: 1px solid black;padding: .5rem;width: 1%;" colspan="4"><b>LWP ( Leave Without Pay) (5)</b><br/>
                            0 Nos. = 5, 1 Nos. = 4, 2 Nos. = 3, 3 Nos. = 2</td>
                            </tr>
                            <tr>
                            <td style="border: 1px solid black;padding: .5rem;width: 1%;" colspan="4"><b>Balanced CL, Vacation Leave (10)</b><br/>
                            1 Nos. = 2, 2 Nos. = 4, 3 Nos. = 6, 4 Nos. = 8, 5 Nos. = 10</td>
                            </tr>
                            <tr>
                            <td style="border: 1px solid black;padding: .5rem;width: 1%;" colspan="4"><b>Memo/ Justification / Clarification if any (10)</b><br/>
                            0 Nos. = 10, 1 Nos. = 5, ≥ 2 Nos.= 0</td>
                            </tr>
                            <tr>
                            <td style="border: 1px solid black;padding: .5rem;width: 1%;" colspan="4"><b>Fine (5)</b><br/>
                            0 Nos. = 5, 1 Nos. = 0, ≥ 2 Nos. = -5</td>
                            </tr>
                            <tr>
                            <td colspan="4">
                            <table style="border: 1px solid black;width: 100%;padding: .5rem;">
                            <tr>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Sr. No</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Late Punch</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Leave Without Pay</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Balanced CL, Vacation Leave</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Memo Justification</th> 
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Fine</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Points Earned</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Verified Name</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Verified ID</th>
                            </tr>

                            ';

                            $i=1;$point=0;
                            $sql = "SELECT * FROM DISC WHERE id='".$id."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    if($row["verify"]==1){
                                        echo'    
                                        <tr>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$i.'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['TLP'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['LWP'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['BL'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['MJC'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['F'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['point'].'</td>
                                            ';
                                        $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                                        $result2 = mysqli_query($conn, $sql2);
                                        if (mysqli_num_rows($result2) > 0) {
                                            while($row2 = mysqli_fetch_assoc($result2)) {
                                                echo'<td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row2['name'].'</td>';
                                            }
                                        }
                                        echo'
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['vid'].'</td>
                                        </tr>
                                        ';
                                        $i=$i+1;
                                        $point=$point+$row['point'];
                                    }
                                }
                                
                            }
                            $epoint=$point;
                            if($i==1){echo'<tr><td colspan="9" style="border: 1px solid black;padding: .5rem;width: 1%;text-align: center;">NO ENTRY</td></tr>';}
                            if($point>35){$point=35;}
                            $fpoint=$fpoint+$point;


                            echo'
                            <tr><td colspan="9" style="border: 1px solid black;padding: .5rem;width: 1%;text-align: center;"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                            </table>
                            </td>
                            </tr>

                            <!-- DP -->

                            <tr>
                            <td style="border: 1px solid black;padding: .5rem;width: 1%;padding-top: 2rem;" colspan="4"><h5><b>Departmental Activities / Portfolio (Max 15 Points)</b></h5>HoD will evaluate performance on particular duty at Dept. level</td>
                            </tr>
                            <tr>
                            <td style="border: 1px solid black;padding: .5rem;width: 1%;" colspan="4">(Max 05 point per duty) (Based on performance on particular duty)<br/>Claim only handled as a coordinator at dept. level activity/portfolio approved and dully
                            signed by HoD and Director office.</td>
                            </tr>
                            <tr>
                            <td colspan="4">
                            <table style="border: 1px solid black;width: 100%;padding: .5rem;">
                            <tr>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Sr. No</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Portfolio Name</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Role</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Duration</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Points Earned</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Verified Name</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Verified ID</th>
                            </tr>
                            ';

                            $i=1;$point=0;
                            $sql = "SELECT * FROM DP WHERE id='".$id."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    if($row["verify"]==1){
                                        echo'    
                                        <tr>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$i.'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['name'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['role'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['duration'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['point'].'</td>
                                            ';
                                        $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                                        $result2 = mysqli_query($conn, $sql2);
                                        if (mysqli_num_rows($result2) > 0) {
                                            while($row2 = mysqli_fetch_assoc($result2)) {
                                                echo'<td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row2['name'].'</td>';
                                            }
                                        }
                                        echo'
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['vid'].'</td>
                                        </tr>
                                        ';
                                        $i=$i+1;
                                        $point=$point+$row['point'];
                                    }
                                }
                                
                            }
                            $epoint=$point;
                            if($i==1){echo'<tr><td colspan="7" style="border: 1px solid black;padding: .5rem;width: 1%;text-align: center;">NO ENTRY</td></tr>';}
                            if($point>15){$point=15;}
                            $fpoint=$fpoint+$point;


                            echo'
                            <tr><td colspan="7" style="border: 1px solid black;padding: .5rem;width: 1%;text-align: center;"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                            </table>
                            </td>
                            </tr>

                            
                            <!-- IP -->

                            <tr>
                            <td style="border: 1px solid black;padding: .5rem;width: 1%;padding-top: 2rem;" colspan="4"><h5><b>Institute Activities/Portfolio (Max 25 Points)</b></h5>(Claim only handled as a coordinator) Director office will evaluate performance on assigned portfolio</td>
                            </tr>
                            <tr>
                            <td style="border: 1px solid black;padding: .5rem;width: 1%;" colspan="4">(Max 05 point per duty for coordinator based on performance on particular duty)<br/>Faculty can claim the points who performed activity or handled portfolio at institute level</td>
                            </tr>
                            <tr>
                            <td colspan="4">
                            <table style="border: 1px solid black;width: 100%;padding: .5rem;">
                            <tr>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Sr. No</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Portfolio Name</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Role</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Duration</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Points Earned</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Verified Name</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Verified ID</th>
                            </tr>
                            ';

                            $i=1;$point=0;
                            $sql = "SELECT * FROM IP WHERE id='".$id."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    if($row["verify"]==1){
                                        echo'    
                                        <tr>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$i.'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['name'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['role'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['duration'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['point'].'</td>
                                            ';
                                        $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                                        $result2 = mysqli_query($conn, $sql2);
                                        if (mysqli_num_rows($result2) > 0) {
                                            while($row2 = mysqli_fetch_assoc($result2)) {
                                                echo'<td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row2['name'].'</td>';
                                            }
                                        }
                                        echo'
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['vid'].'</td>
                                        </tr>
                                        ';
                                        $i=$i+1;
                                        $point=$point+$row['point'];
                                    }
                                }
                                
                            }
                            $epoint=$point;
                            if($i==1){echo'<tr><td colspan="7" style="border: 1px solid black;padding: .5rem;width: 1%;text-align: center;">NO ENTRY</td></tr>';}
                            if($point>25){$point=25;}
                            $fpoint=$fpoint+$point;


                            echo'
                            <tr><td colspan="7" style="border: 1px solid black;padding: .5rem;width: 1%;text-align: center;"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                            </table>
                            </td>
                            </tr>

                            
                            <!-- CTS -->

                            <tr>
                            <td style="border: 1px solid black;padding: .5rem;width: 1%;padding-top: 2rem;" colspan="4"><h5><b>Contribution to Society (Max 10 Points)</b></h5></td>
                            </tr>
                            <tr>
                            <td style="border: 1px solid black;padding: .5rem;width: 1%;" colspan="4">Blood Donation, Activities for orphanage / old age homes / Slum areas Tree plantation, Campus cleaning, activities of National Importance etc. . . . (Subject to submission of proof photos / videos / certificates etc. and verified by HoD and Approvals from Director office)</td>
                            </tr>
                            <tr>
                            <td colspan="4">
                            <table style="border: 1px solid black;width: 100%;padding: .5rem;">
                            <tr>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Sr. No</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Activity Name</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Date</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Points Earned</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Verified Name</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Verified ID</th>
                            </tr>
                            ';

                            $i=1;$point=0;
                            $sql = "SELECT * FROM CTS WHERE id='".$id."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    if($row["verify"]==1){
                                        echo'    
                                        <tr>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$i.'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['activity'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['date'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['point'].'</td>
                                            ';
                                        $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                                        $result2 = mysqli_query($conn, $sql2);
                                        if (mysqli_num_rows($result2) > 0) {
                                            while($row2 = mysqli_fetch_assoc($result2)) {
                                                echo'<td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row2['name'].'</td>';
                                            }
                                        }
                                        echo'
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['vid'].'</td>
                                        </tr>
                                        ';
                                        $i=$i+1;
                                        $point=$point+$row['point'];
                                    }
                                }
                                
                            }
                            $epoint=$point;
                            if($i==1){echo'<tr><td colspan="6" style="border: 1px solid black;padding: .5rem;width: 1%;text-align: center;">NO ENTRY</td></tr>';}
                            if($point>10){$point=10;}
                            $fpoint=$fpoint+$point;


                            echo'
                            <tr><td colspan="6" style="border: 1px solid black;padding: .5rem;width: 1%;text-align: center;"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                            </table>
                            </td>
                            </tr>
                            
                            <!-- RAA1 -->

                            <tr>
                            <td style="border: 1px solid black;padding: .5rem;width: 1%;padding-top: 2rem;" colspan="4"><h5><b>Academic/Research Activity (Max 150 Points)</b></h5></td>
                            </tr>
                            <tr>
                            <td style="border: 1px solid black;padding: .5rem;width: 1%;" colspan="4"><b>Seminar, Workshop, Technical or Motivational Training etc. Organized</b> in house exclusively for institute faculty / students (Max 10), Coordinator: 05 Point </td>
                            </tr>
                            <tr>
                            <td colspan="4">
                            <table style="border: 1px solid black;width: 100%;padding: .5rem;">
                            <tr>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Sr. No</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Activity Name</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Date</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">For</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">No of Participates</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Role</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Points Earned</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Verified Name</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Verified ID</th>
                            </tr>
                            ';
                            $i=1;$point=0;
                            $sql = "SELECT * FROM RAA1 WHERE id='".$id."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    if($row["verify"]==1){
                                        echo'    
                                        <tr>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$i.'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['name'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['date'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['considering'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['participants'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['role'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['point'].'</td>
                                            ';
                                        $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                                        $result2 = mysqli_query($conn, $sql2);
                                        if (mysqli_num_rows($result2) > 0) {
                                            while($row2 = mysqli_fetch_assoc($result2)) {
                                                echo'<td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row2['name'].'</td>';
                                            }
                                        }
                                        echo'
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['vid'].'</td>
                                        </tr>
                                        ';
                                        $i=$i+1;
                                        $point=$point+$row['point'];
                                    }
                                }
                                
                            }
                            $epoint=$point;
                            if($i==1){echo'<tr><td colspan="9" style="border: 1px solid black;padding: .5rem;width: 1%;text-align: center;">NO ENTRY</td></tr>';}
                            if($point>10){$point=10;}
                            $fpoint=$fpoint+$point;




                            echo'
                            <tr><td colspan="9" style="border: 1px solid black;padding: .5rem;width: 1%;text-align: center;"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                            </table>
                            </td>
                            </tr>

                            <!-- RAA2 -->

                            <tr>
                            <td style="border: 1px solid black;padding: .5rem;width: 1%;" colspan="4"><b>Faculty Development Program FDP/STTP organized</b> in the relevant area supported by funding agencies like AICTE / UGC / IITs / GUJCOST / GTU / Government / DTE / Research organization / other institute of National Importance. (Max 10) (2days - 2 Points, 5days - 5 Points, 10 days - 10 Points) Coordinator can claim.</td>
                            </tr>
                            <tr>
                            <td colspan="4">
                            <table style="border: 1px solid black;width: 100%;padding: .5rem;">
                            <tr>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Sr. No</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Activity Name</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Date</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Place</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">No of Participates</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">No of Days</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Agency</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Points Earned</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Verified Name</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Verified ID</th>
                            </tr>
                            ';
                            $i=1;$point=0;
                            $sql = "SELECT * FROM RAA2 WHERE id='".$id."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    if($row["verify"]==1){
                                        echo'    
                                        <tr>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$i.'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['title'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['date'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['place'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['participants'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['days'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['sponsoring_agency'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['point'].'</td>
                                            ';
                                        $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                                        $result2 = mysqli_query($conn, $sql2);
                                        if (mysqli_num_rows($result2) > 0) {
                                            while($row2 = mysqli_fetch_assoc($result2)) {
                                                echo'<td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row2['name'].'</td>';
                                            }
                                        }
                                        echo'
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['vid'].'</td>
                                        </tr>
                                        ';
                                        $i=$i+1;
                                        $point=$point+$row['point'];
                                    }
                                }
                                
                            }
                            $epoint=$point;
                            if($i==1){echo'<tr><td colspan="10" style="border: 1px solid black;padding: .5rem;width: 1%;text-align: center;">NO ENTRY</td></tr>';}
                            if($point>10){$point=10;}
                            $fpoint=$fpoint+$point;




                            echo'
                            <tr><td colspan="10" style="border: 1px solid black;padding: .5rem;width: 1%;text-align: center;"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                            </table>
                            </td>
                            </tr>
                            
                            <!-- RAA3 -->

                            <tr>
                            <td style="border: 1px solid black;padding: .5rem;width: 1%;" colspan="4"><b>Participation in MOOCS courses</b> (One eight weeks duration MOOCS course with E-Certification by NPTEL-SWAYAM-AICTE through GIT NPTEL Cell) 4 weeks: 05 Point ( Max 10 )</td>
                            </tr>
                            <tr>
                            <td colspan="4">
                            <table style="border: 1px solid black;width: 100%;padding: .5rem;">
                            <tr>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Sr. No</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Course Name</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Date</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Exam Date</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Duration (week)</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Points Earned</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Verified Name</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Verified ID</th>
                            </tr>
                            ';
                            $i=1;$point=0;
                            $sql = "SELECT * FROM RAA3 WHERE id='".$id."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    if($row["verify"]==1){
                                        echo'    
                                        <tr>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$i.'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['name'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['date'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['date_of_examination'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['duration'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['point'].'</td>
                                            ';
                                        $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                                        $result2 = mysqli_query($conn, $sql2);
                                        if (mysqli_num_rows($result2) > 0) {
                                            while($row2 = mysqli_fetch_assoc($result2)) {
                                                echo'<td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row2['name'].'</td>';
                                            }
                                        }
                                        echo'
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['vid'].'</td>
                                        </tr>
                                        ';
                                        $i=$i+1;
                                        $point=$point+$row['point'];
                                    }
                                }
                                
                            }
                            $epoint=$point;
                            if($i==1){echo'<tr><td colspan="8" style="border: 1px solid black;padding: .5rem;width: 1%;text-align: center;">NO ENTRY</td></tr>';}
                            if($point>10){$point=10;}
                            $fpoint=$fpoint+$point;




                            echo'
                            <tr><td colspan="8" style="border: 1px solid black;padding: .5rem;width: 1%;text-align: center;"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                            </table>
                            </td>
                            </tr>

                            
                            <!-- RAA4 -->

                            <tr>
                            <td style="border: 1px solid black;padding: .5rem;width: 1%;" colspan="4"><b>Membership of Associations or Professional Bodies (Yearly/Lifetime)</b> Per membership 5 marks (paid membership) (Max 10 Points) Claim only if earn the
                            membership in the specific Academic Year</td>
                            </tr>
                            <tr>
                            <td colspan="4">
                            <table style="border: 1px solid black;width: 100%;padding: .5rem;">
                            <tr>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Sr. No</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Org Name</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Date</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Type</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Membership Number</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Points Earned</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Verified Name</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Verified ID</th>
                            </tr>
                            ';
                            $i=1;$point=0;
                            $sql = "SELECT * FROM RAA4 WHERE id='".$id."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    if($row["verify"]==1){
                                        echo'    
                                        <tr>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$i.'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['name'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['date'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['type'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['membership'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['point'].'</td>
                                            ';
                                        $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                                        $result2 = mysqli_query($conn, $sql2);
                                        if (mysqli_num_rows($result2) > 0) {
                                            while($row2 = mysqli_fetch_assoc($result2)) {
                                                echo'<td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row2['name'].'</td>';
                                            }
                                        }
                                        echo'
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['vid'].'</td>
                                        </tr>
                                        ';
                                        $i=$i+1;
                                        $point=$point+$row['point'];
                                    }
                                }
                                
                            }
                            $epoint=$point;
                            if($i==1){echo'<tr><td colspan="8" style="border: 1px solid black;padding: .5rem;width: 1%;text-align: center;">NO ENTRY</td></tr>';}
                            if($point>10){$point=10;}
                            $fpoint=$fpoint+$point;




                            echo'
                            <tr><td colspan="8" style="border: 1px solid black;padding: .5rem;width: 1%;text-align: center;"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                            </table>
                            </td>
                            </tr>
                            
                            <!-- RAA5 -->

                            <tr>
                            <td style="border: 1px solid black;padding: .5rem;width: 1%;" colspan="4"><b>Research Paper Publication: (Max 35 Points)</b> <br/><br/><b>Research Papers Published in Peer Reviewed Scopus/WoS/GIT-JET listed Journals</b> during academic year: (5 points per paper) with inclusion of GIT name in the affiliation of the paper and Permission from Anveshan (GIT Research Cell) Attach 1st page of publication as a proof. (Max 20 Points)</td>
                            </tr>
                            <tr>
                            <td colspan="4">
                            <table style="border: 1px solid black;width: 100%;padding: .5rem;">
                            <tr>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Sr. No</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Author Name</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Title</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Index</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">ISSN</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Journal Name</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Volume Page</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Points Earned</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Verified Name</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Verified ID</th>
                            </tr>
                            ';
                            $i=1;$point=0;
                            $sql = "SELECT * FROM RAA5 WHERE id='".$id."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    if($row["verify"]==1){
                                        echo'    
                                        <tr>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$i.'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['name'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['title'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['indexing'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['issn'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['journal'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['vpage'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['point'].'</td>
                                            ';
                                        $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                                        $result2 = mysqli_query($conn, $sql2);
                                        if (mysqli_num_rows($result2) > 0) {
                                            while($row2 = mysqli_fetch_assoc($result2)) {
                                                echo'<td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row2['name'].'</td>';
                                            }
                                        }
                                        echo'
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['vid'].'</td>
                                        </tr>
                                        ';
                                        $i=$i+1;
                                        $point=$point+$row['point'];
                                    }
                                }
                                
                            }
                            $epoint=$point;
                            if($i==1){echo'<tr><td colspan="10" style="border: 1px solid black;padding: .5rem;width: 1%;text-align: center;">NO ENTRY</td></tr>';}
                            if($point>20){$point=20;}
                            $fpoint=$fpoint+$point;




                            echo'
                            <tr><td colspan="10" style="border: 1px solid black;padding: .5rem;width: 1%;text-align: center;"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                            </table>
                            </td>
                            </tr>

                            
                            <!-- RAA6 -->

                            <tr>
                            <td style="border: 1px solid black;padding: .5rem;width: 1%;" colspan="4"><b>Research Papers Published in Conference</b> Presented at International conference: (3 points per paper), Presented at National conference: (2 points per paper) and Published Paper in conference: (1 points per paper) with inclusion of GIT name in the affiliation of the paper and Permission from Anveshan (GIT Research Cell) (Max 15 Points)</td>
                            </tr>
                            <tr>
                            <td colspan="4">
                            <table style="border: 1px solid black;width: 100%;padding: .5rem;">
                            <tr>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Sr. No</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Author Name</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Publisher & Index</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Name of Conference, Volume Pages</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Presented/Publish</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Points Earned</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Verified Name</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Verified ID</th>
                            </tr>
                            ';
                            $i=1;$point=0;
                            $sql = "SELECT * FROM RAA6 WHERE id='".$id."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    if($row["verify"]==1){
                                        echo'    
                                        <tr>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$i.'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['name'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['pi'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['cvp'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['pp'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['point'].'</td>
                                            ';
                                        $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                                        $result2 = mysqli_query($conn, $sql2);
                                        if (mysqli_num_rows($result2) > 0) {
                                            while($row2 = mysqli_fetch_assoc($result2)) {
                                                echo'<td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row2['name'].'</td>';
                                            }
                                        }
                                        echo'
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['vid'].'</td>
                                        </tr>
                                        ';
                                        $i=$i+1;
                                        $point=$point+$row['point'];
                                    }
                                }
                                
                            }
                            $epoint=$point;
                            if($i==1){echo'<tr><td colspan="8" style="border: 1px solid black;padding: .5rem;width: 1%;text-align: center;">NO ENTRY</td></tr>';}
                            if($point>15){$point=15;}
                            $fpoint=$fpoint+$point;




                            echo'
                            <tr><td colspan="8" style="border: 1px solid black;padding: .5rem;width: 1%;text-align: center;"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                            </table>
                            </td>
                            </tr>

                            
                            
                            <!-- RAA7 -->

                            <tr>
                            <td style="border: 1px solid black;padding: .5rem;width: 1%;" colspan="4"><b>Books authored which are published by (Max 10 Points)</b><br/>International publishers… 10, National publishers…. 05, Chapter in Edited Book….. 03, Editor of Book by International Publisher 10, Editor of Book by any Publisher 05, with inclusion of GIT name and Permission from Anveshan (GIT Research Cell)</td>
                            </tr>
                            <tr>
                            <td colspan="4">
                            <table style="border: 1px solid black;width: 100%;padding: .5rem;">
                            <tr>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Sr. No</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Title of book</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Authors</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Year</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Publisher</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Points Earned</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Verified Name</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Verified ID</th>
                            </tr>
                            ';
                            $i=1;$point=0;
                            $sql = "SELECT * FROM RAA7 WHERE id='".$id."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    if($row["verify"]==1){
                                        echo'    
                                        <tr>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$i.'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['title'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['authors'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['year'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['publisher'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['point'].'</td>
                                            ';
                                        $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                                        $result2 = mysqli_query($conn, $sql2);
                                        if (mysqli_num_rows($result2) > 0) {
                                            while($row2 = mysqli_fetch_assoc($result2)) {
                                                echo'<td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row2['name'].'</td>';
                                            }
                                        }
                                        echo'
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['vid'].'</td>
                                        </tr>
                                        ';
                                        $i=$i+1;
                                        $point=$point+$row['point'];
                                    }
                                }
                                
                            }
                            $epoint=$point;
                            if($i==1){echo'<tr><td colspan="8" class="text-center fw-light">NO ENTRY</td></tr>';}
                            if($point>10){$point=10;}
                            $fpoint=$fpoint+$point;




                            echo'
                            <tr><td colspan="8" style="border: 1px solid black;padding: .5rem;width: 1%;text-align: center;"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                            </table>
                            </td>
                            </tr>
                            
                            <!-- RAA8 -->

                            <tr>
                            <td style="border: 1px solid black;padding: .5rem;width: 1%;" colspan="4"><b>E-content (Max 10points)</b><br/>(E-Material and Video content as per GIT standard & format - Not from readymade materials available freely on net, exclusively faculty materials) per course developed for institute (per module/lecture. 05 per course) and Submitted to RC in current AY</td>
                            </tr>
                            <tr>
                            <td colspan="4">
                            <table style="border: 1px solid black;width: 100%;padding: .5rem;">
                            <tr>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Sr. No</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Semester</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Subject Code</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Subject Name</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Link</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Points Earned</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Verified Name</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Verified ID</th>
                            </tr>
                            ';
                            $i=1;$point=0;
                            $sql = "SELECT * FROM RAA8 WHERE id='".$id."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    if($row["verify"]==1){
                                        echo'    
                                        <tr>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$i.'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['sem'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['subject'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['name'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['link'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['point'].'</td>
                                            ';
                                        $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                                        $result2 = mysqli_query($conn, $sql2);
                                        if (mysqli_num_rows($result2) > 0) {
                                            while($row2 = mysqli_fetch_assoc($result2)) {
                                                echo'<td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row2['name'].'</td>';
                                            }
                                        }
                                        echo'
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['vid'].'</td>
                                        </tr>
                                        ';
                                        $i=$i+1;
                                        $point=$point+$row['point'];
                                    }
                                }
                                
                            }
                            $epoint=$point;
                            if($i==1){echo'<tr><td colspan="8" style="border: 1px solid black;padding: .5rem;width: 1%;text-align: center;">NO ENTRY</td></tr>';}
                            if($point>10){$point=10;}
                            $fpoint=$fpoint+$point;




                            echo'
                            <tr><td colspan="8" style="border: 1px solid black;padding: .5rem;width: 1%;text-align: center;"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                            </table>
                            </td>
                            </tr>

                            
                            <!-- RAA9 -->

                            <tr>
                            <td style="border: 1px solid black;padding: .5rem;width: 1%;" colspan="4"><b>Patents (Max 20 points)</b><br/>International (Max 20 per patent for granted, 10 for published), National (Max 10 for granted and 04 for published) and Permission taken from Anveshan (GIT Research Cell) in current AY.</td>
                            </tr>
                            <tr>
                            <td colspan="4">
                            <table style="border: 1px solid black;width: 100%;padding: .5rem;">
                            <tr>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Sr. No</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Patent Name</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Option</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Points Earned</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Verified Name</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Verified ID</th>
                            </tr>
                            ';
                            $i=1;$point=0;
                            $sql = "SELECT * FROM RAA9 WHERE id='".$id."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    if($row["verify"]==1){
                                        echo'    
                                        <tr>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$i.'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['name'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['type'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['point'].'</td>
                                            ';
                                        $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                                        $result2 = mysqli_query($conn, $sql2);
                                        if (mysqli_num_rows($result2) > 0) {
                                            while($row2 = mysqli_fetch_assoc($result2)) {
                                                echo'<td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row2['name'].'</td>';
                                            }
                                        }
                                        echo'
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['vid'].'</td>
                                        </tr>
                                        ';
                                        $i=$i+1;
                                        $point=$point+$row['point'];
                                    }
                                }
                                
                            }
                            $epoint=$point;
                            if($i==1){echo'<tr><td colspan="6" style="border: 1px solid black;padding: .5rem;width: 1%;text-align: center;">NO ENTRY</td></tr>';}
                            if($point>20){$point=20;}
                            $fpoint=$fpoint+$point;




                            echo'
                            <tr><td colspan="6" style="border: 1px solid black;padding: .5rem;width: 1%;text-align: center;"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                            </table>
                            </td>
                            </tr>

                            
                            <!-- RAA10 -->

                            <tr>
                            <td style="border: 1px solid black;padding: .5rem;width: 1%;" colspan="4"><b>Research Guidance (Max 30points)</b><br/>Ph.D. (Max 10/per degree awarded), Ph.D. thesis submitted (5 per thesis) UG Project (01 per degree awarded), PG Dissertation (02 per degree awarded) (Subject to approval from SSIP/IIC cell.) (SSIP/IIC: Please verify whether the respective supervisor has followed the mechanism and submitted all documents to the department/SSIP/IIC cell.) </td>
                            </tr>
                            <tr>
                            <td colspan="4">
                            <table style="border: 1px solid black;width: 100%;padding: .5rem;">
                            <tr>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Sr. No</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Program</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">No of Candidate/team/group</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Name of University</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Points Earned</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Verified Name</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Verified ID</th>
                            </tr>
                            ';
                            $i=1;$point=0;
                            $sql = "SELECT * FROM RAA10 WHERE id='".$id."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    if($row["verify"]==1){
                                        echo'    
                                        <tr>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$i.'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['name'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['candidate'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['university'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['point'].'</td>
                                            ';
                                        $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                                        $result2 = mysqli_query($conn, $sql2);
                                        if (mysqli_num_rows($result2) > 0) {
                                            while($row2 = mysqli_fetch_assoc($result2)) {
                                                echo'<td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row2['name'].'</td>';
                                            }
                                        }
                                        echo'
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['vid'].'</td>
                                        </tr>
                                        ';
                                        $i=$i+1;
                                        $point=$point+$row['point'];
                                    }
                                }
                                
                            }
                            $epoint=$point;
                            if($i==1){echo'<tr><td colspan="7" style="border: 1px solid black;padding: .5rem;width: 1%;text-align: center;">NO ENTRY</td></tr>';}
                            if($point>30){$point=30;}
                            $fpoint=$fpoint+$point;




                            echo'
                            <tr><td colspan="7" style="border: 1px solid black;padding: .5rem;width: 1%;text-align: center;"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                            </table>
                            </td>
                            </tr>

                            
                            <!-- INV -->

                            <tr>
                            <td style="border: 1px solid black;padding: .5rem;width: 1%;padding-top: 2rem;" colspan="4"><b>Invited for lectures (Max 5 Points)</b><br/>or as a resource person at other institute(s) / Organization(s) / Conference (Max 5 points): International (within country) 5 point, National 3 point,State / University/ Local: 2 Point with prior permission from Director office</td>
                            </tr>
                            <tr>
                            <td colspan="4">
                            <table style="border: 1px solid black;width: 100%;padding: .5rem;">
                            <tr>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Sr. No</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Institute Name</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Institute Level</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Date</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Topic</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Points Earned</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Verified Name</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Verified ID</th>
                            </tr>
                            ';
                            $i=1;$point=0;
                            $sql = "SELECT * FROM INV WHERE id='".$id."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    if($row["verify"]==1){
                                        echo'    
                                        <tr>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$i.'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['name'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['level'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['date'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['topic'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['point'].'</td>
                                            ';
                                        $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                                        $result2 = mysqli_query($conn, $sql2);
                                        if (mysqli_num_rows($result2) > 0) {
                                            while($row2 = mysqli_fetch_assoc($result2)) {
                                                echo'<td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row2['name'].'</td>';
                                            }
                                        }
                                        echo'
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['vid'].'</td>
                                        </tr>
                                        ';
                                        $i=$i+1;
                                        $point=$point+$row['point'];
                                    }
                                }
                                
                            }
                            $epoint=$point;
                            if($i==1){echo'<tr><td colspan="8" style="border: 1px solid black;padding: .5rem;width: 1%;text-align: center;">NO ENTRY</td></tr>';}
                            if($point>5){$point=5;}
                            $fpoint=$fpoint+$point;




                            echo'
                            <tr><td colspan="8" style="border: 1px solid black;padding: .5rem;width: 1%;text-align: center;"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                            </table>
                            </td>
                            </tr>

                            
                            
                            <!-- AO -->

                            <tr>
                            <td style="border: 1px solid black;padding: .5rem;width: 1%;padding-top: 2rem;" colspan="4"><b>Any other (Max 15 Points)</b><br/>Curricular / Extracurricular / Innovative/ SSIP Project mentorship/ NPTEL Course Mentor / Achievements / Special activities / Admission which you feel to be taken into consideration in appraising your performance. 03 Point per Activity (Subject to submission of proof i.e. photos/ videos / certificates)</td>
                            </tr>
                            <tr>
                            <td colspan="4">
                            <table style="border: 1px solid black;width: 100%;padding: .5rem;">
                            <tr>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Sr. No</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Title</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Points Earned</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Verified Name</th>
                                <th scope="col" style="border: 1px solid black;padding: .5rem;width: 1%;">Verified ID</th>
                            </tr>
                            ';
                            $i=1;$point=0;
                            $sql = "SELECT * FROM AO WHERE id='".$id."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    if($row["verify"]==1){
                                        echo'    
                                        <tr>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$i.'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['title'].'</td>
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['point'].'</td>
                                            ';
                                        $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                                        $result2 = mysqli_query($conn, $sql2);
                                        if (mysqli_num_rows($result2) > 0) {
                                            while($row2 = mysqli_fetch_assoc($result2)) {
                                                echo'<td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row2['name'].'</td>';
                                            }
                                        }
                                        echo'
                                            <td style="border: 1px solid black;padding: .5rem;width: 1%;">'.$row['vid'].'</td>
                                        </tr>
                                        ';
                                        $i=$i+1;
                                        $point=$point+$row['point'];
                                    }
                                }
                                
                            }
                            $epoint=$point;
                            if($i==1){echo'<tr><td colspan="5" style="border: 1px solid black;padding: .5rem;width: 1%;text-align: center;">NO ENTRY</td></tr>';}
                            if($point>15){$point=15;}
                            $fpoint=$fpoint+$point;




                            echo'
                            <tr><td colspan="5" style="border: 1px solid black;padding: .5rem;width: 1%;text-align: center;"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                            </table>
                            </td>
                            </tr>

                        </table>



                        <br/>';
                    }
                    }










                echo '
                <h5 style="margin-left: 5rem;"><b>Total Points Earned: <span style="text-decoration: underline;">'.$fpoint.'</span>/400</b></h5>
                <h5 style="margin-left: 5rem;margin-right: 5rem;border-bottom: 1px solid black;"><b style="display: flex;justify-content: space-between;"><span style="text-align: left;justify-content: flex-start;">Date: ________________</span> <span style="text-align: right;justify-content: flex-end;">Signature of Faculty: ________________</span></b></h5>
                <h5 style="margin-left: 5rem;margin-right: 5rem;"><b>Comments from Head of Department:</b></h5>
                ';

                $sql = "SELECT * FROM comment WHERE id='".$id."'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        if($row['hcomment']){
                            echo'<br/><h4 style="margin-left: 6rem;margin-right: 6rem;">'.$row['hcomment'].'</h4>';
                        }
                        else{
                            echo'<br/><h4 style="margin-left: 6rem;margin-right: 6rem;">Not Commented Yet</h4>';
                        }
                        
                    }
                }

                echo'
                <br/>
                <h5 style="margin-left: 5rem;margin-right: 5rem;border-bottom: 1px solid black;"><b style="display: flex;justify-content: space-between;"><span style="text-align: left;justify-content: flex-start;">Date: ________________</span> <span style="text-align: right;justify-content: flex-end;">Signature of HOD: ________________</span></b></h5>
                <h5 style="margin-left: 5rem;margin-right: 5rem;"><b>Comments from Head of Director:</b></h5>
                ';

                $sql = "SELECT * FROM comment WHERE id='".$id."'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        
                        if($row['dcomment']){
                            echo'<br/><h4 style="margin-left: 6rem;margin-right: 6rem;">'.$row['dcomment'].'</h4>';
                        }
                        else{
                            echo'<br/><h4 style="margin-left: 6rem;margin-right: 6rem;">Not Commented Yet</h4>';
                        }
                    }
                }

                echo'
                <br/>
                <h5 style="margin-left: 5rem;margin-right: 5rem;border-bottom: 1px solid black;"><b style="display: flex;justify-content: right;">Signature of Director: ________________</b></h5>
                <h5 style="margin-left: 5rem;margin-right: 5rem;"><b style="display: flex;justify-content: space-between;"><span style="text-align: left;justify-content: flex-start;">Admin &nbsp;&nbsp;&nbsp; Personal File:</span> <span style="text-align: right;justify-content: flex-end;">Date:________________</span></b></h5>
                ';


                // echo'

                    // <!--<table class="table table-hover">
                    //     <thead>
                    //     <tr><th scope="col" colspan="9" class="text-center"><h5>Teaching Learning Process (50)</h5></th></tr>
                    //     <tr>
                    //         <th scope="col">#</th>
                    //         <th scope="col">Semester</th>
                    //         <th scope="col">Subject Code</th>
                    //         <th scope="col">Subject Name</th>
                    //         <th scope="col">No of Scheduled Classes</th>
                    //         <th scope="col">No of Actually Classes</th>
                    //         <th scope="col">Points</th>
                    //         <th scope="col">Verified Name</th>
                    //         <th scope="col">Verified ID</th>
                    //     </tr>
                    //     </thead>
                    //     <tbody>
                    //     ';
                    //     $i=1;$point=0;
                    //     $sql = "SELECT * FROM TLP WHERE id='".$id."'";
                    //     $result = mysqli_query($conn, $sql);
                    //     if (mysqli_num_rows($result) > 0) {
                    //         while($row = mysqli_fetch_assoc($result)) {
                    //             if($row["verify"]==1){
                    //                 echo'    
                    //                 <tr>
                    //                     <td>'.$i.'</td>
                    //                     <td>'.$row['sem'].'</td>
                    //                     <td>'.$row['subject'].'</td>
                    //                     <td>'.$row['name'].'</td>
                    //                     <td>'.$row['scheduleClass'].'</td>
                    //                     <td>'.$row['actualClass'].'</td>
                    //                     <td>'.$row['point'].'</td>
                    //                     ';
                    //                 $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                    //                 $result2 = mysqli_query($conn, $sql2);
                    //                 if (mysqli_num_rows($result2) > 0) {
                    //                     while($row2 = mysqli_fetch_assoc($result2)) {
                    //                         echo'<td>'.$row2['name'].'</td>';
                    //                     }
                    //                 }
                    //                 echo'
                    //                     <td>'.$row['vid'].'</td>
                    //                 </tr>
                    //                 ';
                    //                 $i=$i+1;
                    //                 $point=$point+$row['point'];
                    //             }
                    //         }
                            
                    //     }
                    //     $epoint=$point;
                    //     if($i==1){echo'<tr><td colspan="9" class="text-center">NO ENTRY</td></tr>';}
                    //     if($point>50){$point=50;}
                    //     $fpoint=$fpoint+$point;
                    //     echo'
                    //     <tr><td colspan="9" class="text-center"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                    //     <tr></tr>
                    //     </tbody>
                    // </table>

                    // <table class="table table-hover mt-5">
                    //     <thead>
                    //     <tr><th scope="col" colspan="10" class="text-center"><h5>GTU Result (100)</h5></th></tr>
                    //     <tr>
                    //         <th scope="col">#</th>
                    //         <th scope="col">Semester</th>
                    //         <th scope="col">Subject Code</th>
                    //         <th scope="col">Subject Name</th>
                    //         <th scope="col">Year</th>
                    //         <th scope="col">Result Of Institute</th>
                    //         <th scope="col">Result Of GTU</th>
                    //         <th scope="col">Points</th>
                    //         <th scope="col">Verified Name</th>
                    //         <th scope="col">Verified ID</th>
                    //     </tr>
                    //     </thead>
                    //     <tbody>
                    //     ';
                    //     $i=1;$point=0;
                    //     $sql = "SELECT * FROM GR WHERE id='".$id."'";
                    //     $result = mysqli_query($conn, $sql);
                    //     if (mysqli_num_rows($result) > 0) {
                    //         while($row = mysqli_fetch_assoc($result)) {
                    //             if($row["verify"]==1){
                    //                 echo'    
                    //                 <tr>
                    //                     <td>'.$i.'</td>
                    //                     <td>'.$row['sem'].'</td>
                    //                     <td>'.$row['subject'].'</td>
                    //                     <td>'.$row['subjectName'].'</td>
                    //                     <td>'.$row['year'].'</td>
                    //                     <td>'.$row['resultInstitute'].'</td>
                    //                     <td>'.$row['resultGtu'].'</td>
                    //                     <td>'.$row['point'].'</td>
                    //                 ';
                    //                 $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                    //                 $result2 = mysqli_query($conn, $sql2);
                    //                 if (mysqli_num_rows($result2) > 0) {
                    //                     while($row2 = mysqli_fetch_assoc($result2)) {
                    //                         echo'<td>'.$row2['name'].'</td>';
                    //                     }
                    //                 }
                    //                 echo'
                    //                     <td>'.$row['vid'].'</td>
                    //                 </tr>
                    //                 ';
                    //                 $i=$i+1;
                    //                 $point=$point+$row['point'];
                    //             }
                    //         }
                            
                    //     }
                    //     $epoint=$point;
                    //     if($i==1){echo'<tr><td colspan="10" class="text-center fw-light">NO ENTRY</td></tr>';}
                    //     if($point>100){$point=100;}
                    //     $fpoint=$fpoint+$point;
                    //     echo'
                    //     <tr><td colspan="10" class="text-center"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                    //     <tr></tr>
                    //     </tbody>
                    // </table>

                    // <table class="table table-hover mt-5">
                    //     <thead>
                    //     <tr><th scope="col" colspan="9" class="text-center"><h5>Discipline (40)</h5></th></tr>
                    //     <tr>
                    //         <th scope="col">#</th>
                    //         <th scope="col">Late Punch</th>
                    //         <th scope="col">Leave Without Pay</th>
                    //         <th scope="col">Balanced CL, Vacation Leave</th>
                    //         <th scope="col">Memo Justification</th>
                    //         <th scope="col">Fine</th>
                    //         <th scope="col">Points</th>
                    //         <th scope="col">Verified Name</th>
                    //         <th scope="col">Verified ID</th>
                    //     </tr>
                    //     </thead>
                    //     <tbody>
                    //     ';
                    //     $i=1;$point=0;
                    //     $sql = "SELECT * FROM DISC WHERE id='".$id."'";
                    //     $result = mysqli_query($conn, $sql);
                    //     if (mysqli_num_rows($result) > 0) {
                    //         while($row = mysqli_fetch_assoc($result)) {
                    //             if($row["verify"]==1){
                    //                 echo'    
                    //                 <tr>
                    //                     <td>'.$i.'</td>
                    //                     <td>'.$row['TLP'].'</td>
                    //                     <td>'.$row['LWP'].'</td>
                    //                     <td>'.$row['BL'].'</td>
                    //                     <td>'.$row['MJC'].'</td>
                    //                     <td>'.$row['F'].'</td>
                    //                     <td>'.$row['point'].'</td>
                    //                     ';
                    //                 $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                    //                 $result2 = mysqli_query($conn, $sql2);
                    //                 if (mysqli_num_rows($result2) > 0) {
                    //                     while($row2 = mysqli_fetch_assoc($result2)) {
                    //                         echo'<td>'.$row2['name'].'</td>';
                    //                     }
                    //                 }
                    //                 echo'
                    //                     <td>'.$row['vid'].'</td>
                    //                 </tr>
                    //                 ';
                    //                 $i=$i+1;
                    //                 $point=$point+$row['point'];
                    //             }
                    //         }
                            
                    //     }
                    //     $epoint=$point;
                    //     if($i==1){echo'<tr><td colspan="9" class="text-center fw-light">NO ENTRY</td></tr>';}
                    //     if($point>40){$point=40;}
                    //     $fpoint=$fpoint+$point;
                    //     echo'
                    //     <tr><td colspan="9" class="text-center"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                    //     <tr></tr>
                    //     </tbody>
                    // </table>

                    // <table class="table table-hover mt-5">
                    //     <thead>
                    //     <tr><th scope="col" colspan="7" class="text-center"><h5>Department Portfolio (20)</h5></th></tr>
                    //     <tr>
                    //         <th scope="col">#</th>
                    //         <th scope="col">Portfolio Name</th>
                    //         <th scope="col">Role</th>
                    //         <th scope="col">Duration</th>
                    //         <th scope="col">Points</th>
                    //         <th scope="col">Verified Name</th>
                    //         <th scope="col">Verified ID</th>
                    //     </tr>
                    //     </thead>
                    //     <tbody>
                    //     ';
                    //     $i=1;$point=0;
                    //     $sql = "SELECT * FROM DP WHERE id='".$id."'";
                    //     $result = mysqli_query($conn, $sql);
                    //     if (mysqli_num_rows($result) > 0) {
                    //         while($row = mysqli_fetch_assoc($result)) {
                    //             if($row["verify"]==1){
                    //                 echo'    
                    //                 <tr>
                    //                     <td>'.$i.'</td>
                    //                     <td>'.$row['name'].'</td>
                    //                     <td>'.$row['role'].'</td>
                    //                     <td>'.$row['duration'].'</td>
                    //                     <td>'.$row['point'].'</td>
                    //                     ';
                    //                 $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                    //                 $result2 = mysqli_query($conn, $sql2);
                    //                 if (mysqli_num_rows($result2) > 0) {
                    //                     while($row2 = mysqli_fetch_assoc($result2)) {
                    //                         echo'<td>'.$row2['name'].'</td>';
                    //                     }
                    //                 }
                    //                 echo'
                    //                     <td>'.$row['vid'].'</td>
                    //                 </tr>
                    //                 ';
                    //                 $i=$i+1;
                    //                 $point=$point+$row['point'];
                    //             }
                    //         }
                            
                    //     }
                    //     $epoint=$point;
                    //     if($i==1){echo'<tr><td colspan="7" class="text-center fw-light">NO ENTRY</td></tr>';}
                    //     if($point>20){$point=20;}
                    //     $fpoint=$fpoint+$point;
                    //     echo'
                    //     <tr><td colspan="7" class="text-center"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                    //     <tr></tr>
                    //     </tbody>
                    // </table>

                    // <table class="table table-hover mt-5">
                    //     <thead>
                    //     <tr><th scope="col" colspan="7" class="text-center"><h5>Institute Portfolio (20)</h5></th></tr>
                    //     <tr>
                    //         <th scope="col">#</th>
                    //         <th scope="col">Portfolio Name</th>
                    //         <th scope="col">Role</th>
                    //         <th scope="col">Duration</th>
                    //         <th scope="col">Points</th>
                    //         <th scope="col">Verified Name</th>
                    //         <th scope="col">Verified ID</th>
                    //     </tr>
                    //     </thead>
                    //     <tbody>
                    //     ';
                    //     $i=1;$point=0;
                    //     $sql = "SELECT * FROM IP WHERE id='".$id."'";
                    //     $result = mysqli_query($conn, $sql);
                    //     if (mysqli_num_rows($result) > 0) {
                    //         while($row = mysqli_fetch_assoc($result)) {
                    //             if($row["verify"]==1){
                    //                 echo'    
                    //                 <tr>
                    //                     <td>'.$i.'</td>
                    //                     <td>'.$row['name'].'</td>
                    //                     <td>'.$row['role'].'</td>
                    //                     <td>'.$row['duration'].'</td>
                    //                     <td>'.$row['point'].'</td>
                    //                     ';
                    //                 $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                    //                 $result2 = mysqli_query($conn, $sql2);
                    //                 if (mysqli_num_rows($result2) > 0) {
                    //                     while($row2 = mysqli_fetch_assoc($result2)) {
                    //                         echo'<td>'.$row2['name'].'</td>';
                    //                     }
                    //                 }
                    //                 echo'
                    //                     <td>'.$row['vid'].'</td>
                    //                 </tr>
                    //                 ';
                    //                 $i=$i+1;
                    //                 $point=$point+$row['point'];
                    //             }
                    //         }
                            
                    //     }
                    //     $epoint=$point;
                    //     if($i==1){echo'<tr><td colspan="7" class="text-center fw-light">NO ENTRY</td></tr>';}
                    //     if($point>20){$point=20;}
                    //     $fpoint=$fpoint+$point;
                    //     echo'
                    //     <tr><td colspan="7" class="text-center"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                    //     <tr></tr>
                    //     </tbody>
                    // </table>

                    // <table class="table table-hover mt-5">
                    //     <thead>
                    //     <tr><th scope="col" colspan="6" class="text-center"><h5>Contribution to Society (10)</h5></th></tr>
                    //     <tr>
                    //         <th scope="col">#</th>
                    //         <th scope="col">Activity Name</th>
                    //         <th scope="col">Date</th>
                    //         <th scope="col">Points</th>
                    //         <th scope="col">Verified Name</th>
                    //         <th scope="col">Verified ID</th>
                    //     </tr>
                    //     </thead>
                    //     <tbody>
                    //     ';
                    //     $i=1;$point=0;
                    //     $sql = "SELECT * FROM CTS WHERE id='".$id."'";
                    //     $result = mysqli_query($conn, $sql);
                    //     if (mysqli_num_rows($result) > 0) {
                    //         while($row = mysqli_fetch_assoc($result)) {
                    //             if($row["verify"]==1){
                    //                 echo'    
                    //                 <tr>
                    //                     <td>'.$i.'</td>
                    //                     <td>'.$row['activity'].'</td>
                    //                     <td>'.$row['date'].'</td>
                    //                     <td>'.$row['point'].'</td>
                    //                     ';
                    //                 $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                    //                 $result2 = mysqli_query($conn, $sql2);
                    //                 if (mysqli_num_rows($result2) > 0) {
                    //                     while($row2 = mysqli_fetch_assoc($result2)) {
                    //                         echo'<td>'.$row2['name'].'</td>';
                    //                     }
                    //                 }
                    //                 echo'
                    //                     <td>'.$row['vid'].'</td>
                    //                 </tr>
                    //                 ';
                    //                 $i=$i+1;
                    //                 $point=$point+$row['point'];
                    //             }
                    //         }
                            
                    //     }
                    //     $epoint=$point;
                    //     if($i==1){echo'<tr><td colspan="6" class="text-center fw-light">NO ENTRY</td></tr>';}
                    //     if($point>10){$point=10;}
                    //     $fpoint=$fpoint+$point;
                    //     echo'
                    //     <tr><td colspan="6" class="text-center"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                    //     <tr></tr>
                    //     </tbody>
                    // </table>

                    // <table class="table table-hover mt-5">
                    //     <thead>
                    //     <tr><th scope="col" colspan="9" class="text-center"><h5>Research and Alied activites (125)</h5></th></tr>
                    //     <tr><th scope="col" colspan="9" class="text-center"><h6>Seminar Workshop, Techinal / Motivational Training Organized (10)</h6></th></tr>
                    //     <tr>
                    //         <th scope="col">#</th>
                    //         <th scope="col">Activity Name</th>
                    //         <th scope="col">Date</th>
                    //         <th scope="col">For</th>
                    //         <th scope="col">No of Participates</th>
                    //         <th scope="col">Role</th>
                    //         <th scope="col">Points</th>
                    //         <th scope="col">Verified Name</th>
                    //         <th scope="col">Verified ID</th>
                    //     </tr>
                    //     </thead>
                    //     <tbody>
                    //     ';
                    //     $i=1;$point=0;
                    //     $sql = "SELECT * FROM RAA1 WHERE id='".$id."'";
                    //     $result = mysqli_query($conn, $sql);
                    //     if (mysqli_num_rows($result) > 0) {
                    //         while($row = mysqli_fetch_assoc($result)) {
                    //             if($row["verify"]==1){
                    //                 echo'    
                    //                 <tr>
                    //                     <td>'.$i.'</td>
                    //                     <td>'.$row['name'].'</td>
                    //                     <td>'.$row['date'].'</td>
                    //                     <td>'.$row['considering'].'</td>
                    //                     <td>'.$row['participants'].'</td>
                    //                     <td>'.$row['role'].'</td>
                    //                     <td>'.$row['point'].'</td>
                    //                     ';
                    //                 $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                    //                 $result2 = mysqli_query($conn, $sql2);
                    //                 if (mysqli_num_rows($result2) > 0) {
                    //                     while($row2 = mysqli_fetch_assoc($result2)) {
                    //                         echo'<td>'.$row2['name'].'</td>';
                    //                     }
                    //                 }
                    //                 echo'
                    //                     <td>'.$row['vid'].'</td>
                    //                 </tr>
                    //                 ';
                    //                 $i=$i+1;
                    //                 $point=$point+$row['point'];
                    //             }
                    //         }
                            
                    //     }
                    //     $epoint=$point;
                    //     if($i==1){echo'<tr><td colspan="9" class="text-center fw-light">NO ENTRY</td></tr>';}
                    //     if($point>10){$point=10;}
                    //     $fpoint=$fpoint+$point;
                    //     echo'
                    //     <tr><td colspan="9" class="text-center"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                    //     <tr></tr>
                    //     </tbody>
                    // </table>

                    // <table class="table table-hover mt-5">
                    //     <thead>
                    //     <tr><th scope="col" colspan="10" class="text-center"><h6>Faculty Program FDP/STTP Organized (10)</h6></th></tr>
                    //     <tr>
                    //         <th scope="col">#</th>
                    //         <th scope="col">Activity Name</th>
                    //         <th scope="col">Date</th>
                    //         <th scope="col">Place</th>
                    //         <th scope="col">No of Participates</th>
                    //         <th scope="col">No of Days</th>
                    //         <th scope="col">Agency</th>
                    //         <th scope="col">Points</th>
                    //         <th scope="col">Verified Name</th>
                    //         <th scope="col">Verified ID</th>
                    //     </tr>
                    //     </thead>
                    //     <tbody>
                    //     ';
                    //     $i=1;$point=0;
                    //     $sql = "SELECT * FROM RAA2 WHERE id='".$id."'";
                    //     $result = mysqli_query($conn, $sql);
                    //     if (mysqli_num_rows($result) > 0) {
                    //         while($row = mysqli_fetch_assoc($result)) {
                    //             if($row["verify"]==1){
                    //                 echo'    
                    //                 <tr>
                    //                     <td>'.$i.'</td>
                    //                     <td>'.$row['title'].'</td>
                    //                     <td>'.$row['date'].'</td>
                    //                     <td>'.$row['place'].'</td>
                    //                     <td>'.$row['participants'].'</td>
                    //                     <td>'.$row['days'].'</td>
                    //                     <td>'.$row['sponsoring_agency'].'</td>
                    //                     <td>'.$row['point'].'</td>
                    //                     ';
                    //                 $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                    //                 $result2 = mysqli_query($conn, $sql2);
                    //                 if (mysqli_num_rows($result2) > 0) {
                    //                     while($row2 = mysqli_fetch_assoc($result2)) {
                    //                         echo'<td>'.$row2['name'].'</td>';
                    //                     }
                    //                 }
                    //                 echo'
                    //                     <td>'.$row['vid'].'</td>
                    //                 </tr>
                    //                 ';
                    //                 $i=$i+1;
                    //                 $point=$point+$row['point'];
                    //             }
                    //         }
                            
                    //     }
                    //     $epoint=$point;
                    //     if($i==1){echo'<tr><td colspan="10" class="text-center fw-light">NO ENTRY</td></tr>';}
                    //     if($point>10){$point=10;}
                    //     $fpoint=$fpoint+$point;
                    //     echo'
                    //     <tr><td colspan="10" class="text-center"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                    //     <tr></tr>
                    //     </tbody>
                    // </table>

                    // <table class="table table-hover mt-5">
                    //     <thead>
                    //     <tr><th scope="col" colspan="8" class="text-center"><h6>Participation in MOOCS courses (10)</h6></th></tr>
                    //     <tr>
                    //         <th scope="col">#</th>
                    //         <th scope="col">Course Name</th>
                    //         <th scope="col">Date</th>
                    //         <th scope="col">Exam Date</th>
                    //         <th scope="col">Duration (week)</th>
                    //         <th scope="col">Points</th>
                    //         <th scope="col">Verified Name</th>
                    //         <th scope="col">Verified ID</th>
                    //     </tr>
                    //     </thead>
                    //     <tbody>
                    //     ';
                    //     $i=1;$point=0;
                    //     $sql = "SELECT * FROM RAA3 WHERE id='".$id."'";
                    //     $result = mysqli_query($conn, $sql);
                    //     if (mysqli_num_rows($result) > 0) {
                    //         while($row = mysqli_fetch_assoc($result)) {
                    //             if($row["verify"]==1){
                    //                 echo'    
                    //                 <tr>
                    //                     <td>'.$i.'</td>
                    //                     <td>'.$row['name'].'</td>
                    //                     <td>'.$row['date'].'</td>
                    //                     <td>'.$row['date_of_examination'].'</td>
                    //                     <td>'.$row['duration'].'</td>
                    //                     <td>'.$row['point'].'</td>
                    //                     ';
                    //                 $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                    //                 $result2 = mysqli_query($conn, $sql2);
                    //                 if (mysqli_num_rows($result2) > 0) {
                    //                     while($row2 = mysqli_fetch_assoc($result2)) {
                    //                         echo'<td>'.$row2['name'].'</td>';
                    //                     }
                    //                 }
                    //                 echo'
                    //                     <td>'.$row['vid'].'</td>
                    //                 </tr>
                    //                 ';
                    //                 $i=$i+1;
                    //                 $point=$point+$row['point'];
                    //             }
                    //         }
                            
                    //     }
                    //     $epoint=$point;
                    //     if($i==1){echo'<tr><td colspan="8" class="text-center fw-light">NO ENTRY</td></tr>';}
                    //     if($point>10){$point=10;}
                    //     $fpoint=$fpoint+$point;
                    //     echo'
                    //     <tr><td colspan="8" class="text-center"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                    //     <tr></tr>
                    //     </tbody>
                    // </table>

                    // <table class="table table-hover mt-5">
                    //     <thead>
                    //     <tr><th scope="col" colspan="8" class="text-center"><h6>Membership of Associations or Professional Bodies (10)</h6></th></tr>
                    //     <tr>
                    //         <th scope="col">#</th>
                    //         <th scope="col">Org Name</th>
                    //         <th scope="col">Date</th>
                    //         <th scope="col">Type</th>
                    //         <th scope="col">Membership Number</th>
                    //         <th scope="col">Points</th>
                    //         <th scope="col">Verified Name</th>
                    //         <th scope="col">Verified ID</th>
                    //     </tr>
                    //     </thead>
                    //     <tbody>
                    //     ';
                    //     $i=1;$point=0;
                    //     $sql = "SELECT * FROM RAA4 WHERE id='".$id."'";
                    //     $result = mysqli_query($conn, $sql);
                    //     if (mysqli_num_rows($result) > 0) {
                    //         while($row = mysqli_fetch_assoc($result)) {
                    //             if($row["verify"]==1){
                    //                 echo'    
                    //                 <tr>
                    //                     <td>'.$i.'</td>
                    //                     <td>'.$row['name'].'</td>
                    //                     <td>'.$row['date'].'</td>
                    //                     <td>'.$row['type'].'</td>
                    //                     <td>'.$row['membership'].'</td>
                    //                     <td>'.$row['point'].'</td>
                    //                     ';
                    //                 $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                    //                 $result2 = mysqli_query($conn, $sql2);
                    //                 if (mysqli_num_rows($result2) > 0) {
                    //                     while($row2 = mysqli_fetch_assoc($result2)) {
                    //                         echo'<td>'.$row2['name'].'</td>';
                    //                     }
                    //                 }
                    //                 echo'
                    //                     <td>'.$row['vid'].'</td>
                    //                 </tr>
                    //                 ';
                    //                 $i=$i+1;
                    //                 $point=$point+$row['point'];
                    //             }
                    //         }
                            
                    //     }
                    //     $epoint=$point;
                    //     if($i==1){echo'<tr><td colspan="8" class="text-center fw-light">NO ENTRY</td></tr>';}
                    //     if($point>10){$point=10;}
                    //     $fpoint=$fpoint+$point;
                    //     echo'
                    //     <tr><td colspan="8" class="text-center"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                    //     <tr></tr>
                    //     </tbody>
                    // </table>

                    // <table class="table table-hover mt-5">
                    //     <thead>
                    //     <tr><th scope="col" colspan="10" class="text-center"><h6>Research Paper Published in Peer Reviewed SCI/Scopus/JET or UGC listed Journals (10)</h6></th></tr>
                    //     <tr>
                    //         <th scope="col">#</th>
                    //         <th scope="col">Author Name</th>
                    //         <th scope="col">Title</th>
                    //         <th scope="col">Index</th>
                    //         <th scope="col">ISSN</th>
                    //         <th scope="col">Journal Name</th>
                    //         <th scope="col">Volume Page</th>
                    //         <th scope="col">Points</th>
                    //         <th scope="col">Verified Name</th>
                    //         <th scope="col">Verified ID</th>
                    //     </tr>
                    //     </thead>
                    //     <tbody>
                    //     ';
                    //     $i=1;$point=0;
                    //     $sql = "SELECT * FROM RAA5 WHERE id='".$id."'";
                    //     $result = mysqli_query($conn, $sql);
                    //     if (mysqli_num_rows($result) > 0) {
                    //         while($row = mysqli_fetch_assoc($result)) {
                    //             if($row["verify"]==1){
                    //                 echo'    
                    //                 <tr>
                    //                     <td>'.$i.'</td>
                    //                     <td>'.$row['name'].'</td>
                    //                     <td>'.$row['title'].'</td>
                    //                     <td>'.$row['indexing'].'</td>
                    //                     <td>'.$row['issn'].'</td>
                    //                     <td>'.$row['journal'].'</td>
                    //                     <td>'.$row['vpage'].'</td>
                    //                     <td>'.$row['point'].'</td>
                    //                     ';
                    //                 $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                    //                 $result2 = mysqli_query($conn, $sql2);
                    //                 if (mysqli_num_rows($result2) > 0) {
                    //                     while($row2 = mysqli_fetch_assoc($result2)) {
                    //                         echo'<td>'.$row2['name'].'</td>';
                    //                     }
                    //                 }
                    //                 echo'
                    //                     <td>'.$row['vid'].'</td>
                    //                 </tr>
                    //                 ';
                    //                 $i=$i+1;
                    //                 $point=$point+$row['point'];
                    //             }
                    //         }
                            
                    //     }
                    //     $epoint=$point;
                    //     if($i==1){echo'<tr><td colspan="10" class="text-center fw-light">NO ENTRY</td></tr>';}
                    //     if($point>10){$point=10;}
                    //     $fpoint=$fpoint+$point;
                    //     echo'
                    //     <tr><td colspan="10" class="text-center"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                    //     <tr></tr>
                    //     </tbody>
                    // </table>

                    // <table class="table table-hover mt-5">
                    //     <thead>
                    //     <tr><th scope="col" colspan="8" class="text-center"><h6>Research Paper Publication in Conference (10)</h6></th></tr>
                    //     <tr>
                    //         <th scope="col">#</th>
                    //         <th scope="col">Author Name</th>
                    //         <th scope="col">Publisher & Index</th>
                    //         <th scope="col">Name of Conference, Volume Pages</th>
                    //         <th scope="col">Presented/Publish</th>
                    //         <th scope="col">Points</th>
                    //         <th scope="col">Verified Name</th>
                    //         <th scope="col">Verified ID</th>
                    //     </tr>
                    //     </thead>
                    //     <tbody>
                    //     ';
                    //     $i=1;$point=0;
                    //     $sql = "SELECT * FROM RAA6 WHERE id='".$id."'";
                    //     $result = mysqli_query($conn, $sql);
                    //     if (mysqli_num_rows($result) > 0) {
                    //         while($row = mysqli_fetch_assoc($result)) {
                    //             if($row["verify"]==1){
                    //                 echo'    
                    //                 <tr>
                    //                     <td>'.$i.'</td>
                    //                     <td>'.$row['name'].'</td>
                    //                     <td>'.$row['pi'].'</td>
                    //                     <td>'.$row['cvp'].'</td>
                    //                     <td>'.$row['pp'].'</td>
                    //                     <td>'.$row['point'].'</td>
                    //                     ';
                    //                 $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                    //                 $result2 = mysqli_query($conn, $sql2);
                    //                 if (mysqli_num_rows($result2) > 0) {
                    //                     while($row2 = mysqli_fetch_assoc($result2)) {
                    //                         echo'<td>'.$row2['name'].'</td>';
                    //                     }
                    //                 }
                    //                 echo'
                    //                     <td>'.$row['vid'].'</td>
                    //                 </tr>
                    //                 ';
                    //                 $i=$i+1;
                    //                 $point=$point+$row['point'];
                    //             }
                    //         }
                            
                    //     }
                    //     $epoint=$point;
                    //     if($i==1){echo'<tr><td colspan="8" class="text-center fw-light">NO ENTRY</td></tr>';}
                    //     if($point>10){$point=10;}
                    //     $fpoint=$fpoint+$point;
                    //     echo'
                    //     <tr><td colspan="8" class="text-center"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                    //     <tr></tr>
                    //     </tbody>
                    // </table>

                    // <table class="table table-hover mt-5">
                    //     <thead>
                    //     <tr><th scope="col" colspan="8" class="text-center"><h6>Books authored  which are published by (10)</h6></th></tr>
                    //     <tr>
                    //         <th scope="col">#</th>
                    //         <th scope="col">Title of book</th>
                    //         <th scope="col">Authors</th>
                    //         <th scope="col">Year</th>
                    //         <th scope="col">Publisher</th>
                    //         <th scope="col">Points</th>
                    //         <th scope="col">Verified Name</th>
                    //         <th scope="col">Verified ID</th>
                    //     </tr>
                    //     </thead>
                    //     <tbody>
                    //     ';
                    //     $i=1;$point=0;
                    //     $sql = "SELECT * FROM RAA7 WHERE id='".$id."'";
                    //     $result = mysqli_query($conn, $sql);
                    //     if (mysqli_num_rows($result) > 0) {
                    //         while($row = mysqli_fetch_assoc($result)) {
                    //             if($row["verify"]==1){
                    //                 echo'    
                    //                 <tr>
                    //                     <td>'.$i.'</td>
                    //                     <td>'.$row['title'].'</td>
                    //                     <td>'.$row['authors'].'</td>
                    //                     <td>'.$row['year'].'</td>
                    //                     <td>'.$row['publisher'].'</td>
                    //                     <td>'.$row['point'].'</td>
                    //                     ';
                    //                 $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                    //                 $result2 = mysqli_query($conn, $sql2);
                    //                 if (mysqli_num_rows($result2) > 0) {
                    //                     while($row2 = mysqli_fetch_assoc($result2)) {
                    //                         echo'<td>'.$row2['name'].'</td>';
                    //                     }
                    //                 }
                    //                 echo'
                    //                     <td>'.$row['vid'].'</td>
                    //                 </tr>
                    //                 ';
                    //                 $i=$i+1;
                    //                 $point=$point+$row['point'];
                    //             }
                    //         }
                            
                    //     }
                    //     $epoint=$point;
                    //     if($i==1){echo'<tr><td colspan="8" class="text-center fw-light">NO ENTRY</td></tr>';}
                    //     if($point>10){$point=10;}
                    //     $fpoint=$fpoint+$point;
                    //     echo'
                    //     <tr><td colspan="8" class="text-center"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                    //     <tr></tr>
                    //     </tbody>
                    // </table>

                    // <table class="table table-hover mt-5">
                    //     <thead>
                    //     <tr><th scope="col" colspan="8" class="text-center"><h6>E-content (10)</h6></th></tr>
                    //     <tr>
                    //         <th scope="col">#</th>
                    //         <th scope="col">Sem</th>
                    //         <th scope="col">Subject Code</th>
                    //         <th scope="col">Subject Name</th>
                    //         <th scope="col">Link</th>
                    //         <th scope="col">Points</th>
                    //         <th scope="col">Verified Name</th>
                    //         <th scope="col">Verified ID</th>
                    //     </tr>
                    //     </thead>
                    //     <tbody>
                    //     ';
                    //     $i=1;$point=0;
                    //     $sql = "SELECT * FROM RAA8 WHERE id='".$id."'";
                    //     $result = mysqli_query($conn, $sql);
                    //     if (mysqli_num_rows($result) > 0) {
                    //         while($row = mysqli_fetch_assoc($result)) {
                    //             if($row["verify"]==1){
                    //                 echo'    
                    //                 <tr>
                    //                     <td>'.$i.'</td>
                    //                     <td>'.$row['sem'].'</td>
                    //                     <td>'.$row['subject'].'</td>
                    //                     <td>'.$row['name'].'</td>
                    //                     <td>'.$row['link'].'</td>
                    //                     <td>'.$row['point'].'</td>
                    //                     ';
                    //                 $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                    //                 $result2 = mysqli_query($conn, $sql2);
                    //                 if (mysqli_num_rows($result2) > 0) {
                    //                     while($row2 = mysqli_fetch_assoc($result2)) {
                    //                         echo'<td>'.$row2['name'].'</td>';
                    //                     }
                    //                 }
                    //                 echo'
                    //                     <td>'.$row['vid'].'</td>
                    //                 </tr>
                    //                 ';
                    //                 $i=$i+1;
                    //                 $point=$point+$row['point'];
                    //             }
                    //         }
                            
                    //     }
                    //     $epoint=$point;
                    //     if($i==1){echo'<tr><td colspan="8" class="text-center fw-light">NO ENTRY</td></tr>';}
                    //     if($point>10){$point=10;}
                    //     $fpoint=$fpoint+$point;
                    //     echo'
                    //     <tr><td colspan="8" class="text-center"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                    //     <tr></tr>
                    //     </tbody>
                    // </table>

                    // <table class="table table-hover mt-5">
                    //     <thead>
                    //     <tr><th scope="col" colspan="6" class="text-center"><h6>Patents (20)</h6></th></tr>
                    //     <tr>
                    //         <th scope="col">#</th>
                    //         <th scope="col">Patent Name</th>
                    //         <th scope="col">Option</th>
                    //         <th scope="col">Points</th>
                    //         <th scope="col">Verified Name</th>
                    //         <th scope="col">Verified ID</th>
                    //     </tr>
                    //     </thead>
                    //     <tbody>
                    //     ';
                    //     $i=1;$point=0;
                    //     $sql = "SELECT * FROM RAA9 WHERE id='".$id."'";
                    //     $result = mysqli_query($conn, $sql);
                    //     if (mysqli_num_rows($result) > 0) {
                    //         while($row = mysqli_fetch_assoc($result)) {
                    //             if($row["verify"]==1){
                    //                 echo'    
                    //                 <tr>
                    //                     <td>'.$i.'</td>
                    //                     <td>'.$row['name'].'</td>
                    //                     <td>'.$row['type'].'</td>
                    //                     <td>'.$row['point'].'</td>
                    //                     ';
                    //                 $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                    //                 $result2 = mysqli_query($conn, $sql2);
                    //                 if (mysqli_num_rows($result2) > 0) {
                    //                     while($row2 = mysqli_fetch_assoc($result2)) {
                    //                         echo'<td>'.$row2['name'].'</td>';
                    //                     }
                    //                 }
                    //                 echo'
                    //                     <td>'.$row['vid'].'</td>
                    //                 </tr>
                    //                 ';
                    //                 $i=$i+1;
                    //                 $point=$point+$row['point'];
                    //             }
                    //         }
                            
                    //     }
                    //     $epoint=$point;
                    //     if($i==1){echo'<tr><td colspan="6" class="text-center fw-light">NO ENTRY</td></tr>';}
                    //     if($point>20){$point=20;}
                    //     $fpoint=$fpoint+$point;
                    //     echo'
                    //     <tr><td colspan="6" class="text-center"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                    //     <tr></tr>
                    //     </tbody>
                    // </table>

                    // <table class="table table-hover mt-5">
                    //     <thead>
                    //     <tr><th scope="col" colspan="7" class="text-center"><h6>Research Guidance (30)</h6></th></tr>
                    //     <tr>
                    //         <th scope="col">#</th>
                    //         <th scope="col">Program</th>
                    //         <th scope="col">No of Candidate/team/group</th>
                    //         <th scope="col">Name of University</th>
                    //         <th scope="col">Points</th>
                    //         <th scope="col">Verified Name</th>
                    //         <th scope="col">Verified ID</th>
                    //     </tr>
                    //     </thead>
                    //     <tbody>
                    //     ';
                    //     $i=1;$point=0;
                    //     $sql = "SELECT * FROM RAA10 WHERE id='".$id."'";
                    //     $result = mysqli_query($conn, $sql);
                    //     if (mysqli_num_rows($result) > 0) {
                    //         while($row = mysqli_fetch_assoc($result)) {
                    //             if($row["verify"]==1){
                    //                 echo'    
                    //                 <tr>
                    //                     <td>'.$i.'</td>
                    //                     <td>'.$row['name'].'</td>
                    //                     <td>'.$row['candidate'].'</td>
                    //                     <td>'.$row['university'].'</td>
                    //                     <td>'.$row['point'].'</td>
                    //                     ';
                    //                 $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                    //                 $result2 = mysqli_query($conn, $sql2);
                    //                 if (mysqli_num_rows($result2) > 0) {
                    //                     while($row2 = mysqli_fetch_assoc($result2)) {
                    //                         echo'<td>'.$row2['name'].'</td>';
                    //                     }
                    //                 }
                    //                 echo'
                    //                     <td>'.$row['vid'].'</td>
                    //                 </tr>
                    //                 ';
                    //                 $i=$i+1;
                    //                 $point=$point+$row['point'];
                    //             }
                    //         }
                            
                    //     }
                    //     $epoint=$point;
                    //     if($i==1){echo'<tr><td colspan="7" class="text-center fw-light">NO ENTRY</td></tr>';}
                    //     if($point>30){$point=30;}
                    //     $fpoint=$fpoint+$point;
                    //     echo'
                    //     <tr><td colspan="7" class="text-center"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                    //     <tr></tr>
                    //     </tbody>
                    // </table>

                    // <table class="table table-hover mt-5">
                    //     <thead>
                    //     <tr><th scope="col" colspan="8" class="text-center"><h5>Invited For Lectures (5)</h5></th></tr>
                    //     <tr>
                    //         <th scope="col">#</th>
                    //         <th scope="col">Institute Name</th>
                    //         <th scope="col">Institute Level</th>
                    //         <th scope="col">Date</th>
                    //         <th scope="col">Topic</th>
                    //         <th scope="col">Points</th>
                    //         <th scope="col">Verified Name</th>
                    //         <th scope="col">Verified ID</th>
                    //     </tr>
                    //     </thead>
                    //     <tbody>
                    //     ';
                    //     $i=1;$point=0;
                    //     $sql = "SELECT * FROM INV WHERE id='".$id."'";
                    //     $result = mysqli_query($conn, $sql);
                    //     if (mysqli_num_rows($result) > 0) {
                    //         while($row = mysqli_fetch_assoc($result)) {
                    //             if($row["verify"]==1){
                    //                 echo'    
                    //                 <tr>
                    //                     <td>'.$i.'</td>
                    //                     <td>'.$row['name'].'</td>
                    //                     <td>'.$row['level'].'</td>
                    //                     <td>'.$row['date'].'</td>
                    //                     <td>'.$row['topic'].'</td>
                    //                     <td>'.$row['point'].'</td>
                    //                     ';
                    //                 $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                    //                 $result2 = mysqli_query($conn, $sql2);
                    //                 if (mysqli_num_rows($result2) > 0) {
                    //                     while($row2 = mysqli_fetch_assoc($result2)) {
                    //                         echo'<td>'.$row2['name'].'</td>';
                    //                     }
                    //                 }
                    //                 echo'
                    //                     <td>'.$row['vid'].'</td>
                    //                 </tr>
                    //                 ';
                    //                 $i=$i+1;
                    //                 $point=$point+$row['point'];
                    //             }
                    //         }
                            
                    //     }
                    //     $epoint=$point;
                    //     if($i==1){echo'<tr><td colspan="8" class="text-center fw-light">NO ENTRY</td></tr>';}
                    //     if($point>5){$point=5;}
                    //     $fpoint=$fpoint+$point;
                    //     echo'
                    //     <tr><td colspan="8" class="text-center"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                    //     <tr></tr>
                    //     </tbody>
                    // </table>

                    // <table class="table table-hover mt-5">
                    //     <thead>
                    //     <tr><th scope="col" colspan="5" class="text-center"><h5>Any Other (15)</h5></th></tr>
                    //     <tr>
                    //         <th scope="col">#</th>
                    //         <th scope="col">title</th>
                    //         <th scope="col">Points</th>
                    //         <th scope="col">Verified Name</th>
                    //         <th scope="col">Verified ID</th>
                    //     </tr>
                    //     </thead>
                    //     <tbody>
                    //     ';
                    //     $i=1;$point=0;
                    //     $sql = "SELECT * FROM AO WHERE id='".$id."'";
                    //     $result = mysqli_query($conn, $sql);
                    //     if (mysqli_num_rows($result) > 0) {
                    //         while($row = mysqli_fetch_assoc($result)) {
                    //             if($row["verify"]==1){
                    //                 echo'    
                    //                 <tr>
                    //                     <td>'.$i.'</td>
                    //                     <td>'.$row['title'].'</td>
                    //                     <td>'.$row['point'].'</td>
                    //                     ';
                    //                 $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                    //                 $result2 = mysqli_query($conn, $sql2);
                    //                 if (mysqli_num_rows($result2) > 0) {
                    //                     while($row2 = mysqli_fetch_assoc($result2)) {
                    //                         echo'<td>'.$row2['name'].'</td>';
                    //                     }
                    //                 }
                    //                 echo'
                    //                     <td>'.$row['vid'].'</td>
                    //                 </tr>
                    //                 ';
                    //                 $i=$i+1;
                    //                 $point=$point+$row['point'];
                    //             }
                    //         }
                            
                    //     }
                    //     $epoint=$point;
                    //     if($i==1){echo'<tr><td colspan="5" class="text-center fw-light">NO ENTRY</td></tr>';}
                    //     if($point>5){$point=5;}
                    //     $fpoint=$fpoint+$point;
                    //     echo'
                    //     <tr><td colspan="5" class="text-center"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                    //     <tr></tr>
                    //     </tbody>
                    // </table> -->
                //';

                

                //     $sql = "SELECT * FROM comment WHERE id='".$id."'";
                //     $result = mysqli_query($conn, $sql);
                //     if (mysqli_num_rows($result) > 0) {
                //         while($row = mysqli_fetch_assoc($result)) {
                //             if($row['hcomment']){
                //                 echo'<h3 class="mt-5">HOD Comment : '.$row['hcomment'].'</h3>';
                //             }
                //             else{
                //                 echo'<h3 class="mt-5">HOD Comment : Not Commented Yet</h3>';
                //             }
                            
                //             if($row['dcomment']){
                //                 echo'<h3 class="">Director Comment : '.$row['dcomment'].'</h3>';
                //             }
                //             else{
                //                 echo'<h3 class="">Director Comment : Not Commented Yet</h3>';
                //             }
                //         }
                //     }
                

                // echo'<h3 class="mt-5 imgcl"><b><span class="highlight" style="background-image: linear-gradient(to right, #F27121cc, #E94057cc, #8A2387cc);border-radius: 6px;padding: 3px 6px;color: #fff;text-align: center;font-family: sans-serif;">FINAL POINT : '.$fpoint.'/400</span></b></h3>
            
            
            echo'</div>';
            $i=$i+1;
            }

?>