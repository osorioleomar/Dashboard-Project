              <small>
                <?php 
                //array for icons
                  $icons = array(
                    'Leads' => 'fa fa-user',
                    'Accounts' => 'fa fa-building',
                    'Contacts' => 'fa fa-phone',
                    'Potentials' => 'fa fa-money',
                    'Campaigns' => 'fa fa-calendar',
                    'Project' => 'fa fa-dashboard'
                    );
                  if(empty($comments)){
                    echo "No result. Please try a different query.";
                  }else{

                foreach($comments as $comment){ ?>
                  <i class="<?php echo $icons[$comment->module]; ?>"></i> (<?php echo $comment->createdtime ?>)<?php echo $comment->user ?> wrote a comment on <em><?php echo $comment->related_to ?><em>: <br> 
                     - <strong><?php echo $comment->comment ?></strong>
                        <br><br>
                <?php } } ?>
              </small>