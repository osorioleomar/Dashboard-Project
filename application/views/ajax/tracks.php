              <small>
                <?php 
                //array for icons
                  $icons = array(
                    'Leads' => 'fa fa-user',
                    'Accounts' => 'fa fa-building',
                    'Contacts' => 'fa fa-phone',
                    'Potentials' => 'fa fa-money',
                    'ModComments' => 'fa fa-comments',
                    'Campaigns' => 'fa fa-calendar'
                    );

                  //array for user names
                  foreach ($users as $user) {
                    $name[$user->id] = $user->name;
                  };

                  //array for fields
                  foreach($fields as $row){
                    $field[$row->fieldname] = $row->fieldlabel;
                  };

if($updates->num_rows() == 0){
  echo "No result. Please try again with different parameters.";
}else{

                foreach($updates->result() as $trails){ ?>
                  <i class="<?php echo $icons[$trails->setype]; ?>"></i> <strong><?php echo $trails->label ?></strong> was updated by <?php echo $trails->user ?> on <?php echo $trails->changedon ?><br>
                     - Set <?php echo $field[$trails->fieldname] ?>
                      <?php 
                        if($trails->prevalue != ""){
                          if($trails->fieldname == 'assigned_user_id'){
                            echo " from <strong><em>" . $name[$trails->prevalue] . "</em></strong>";
                          }else{
                            echo " from <strong><em>" . $trails->prevalue . "</em></strong>"; 
                          }
                        
                        } 
                      ?>
                       to <?php
                          if($trails->fieldname == 'assigned_user_id'){
                              echo "<em><strong>" . $name[$trails->postvalue] . "</strong></em>";
                          }else{
                              echo "<em><strong>" . $trails->postvalue . "</strong></em>"; 
                          }
                        ?> 
                        <br><br>
                <?php } } ?>
              </small>