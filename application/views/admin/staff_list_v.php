<table class="luft-table luft-view-mobile">
    <thead>
        <tr>
          <th class="luft-user-id"><?php thead('id'); ?>  </th>
          <th class="luft-user-name"><?php thead('label_name', 'username'); ?></th>
          <th class="luft-staff-work-time" ><?php echo get_msg( 'work_time' ) ?></th>
          <th class="luft-update-download"></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($staffs as $key => $staff): ?>
        <tr>
            <td class="luft-user-id"><?php echo $key+1; ?></td>
            <td class="luft-user-name"><?php echo $staff->username; ?></td>
            <td class="luft-staff-work-time"> <?php echo get_staff_worktime( $staff->id ) ?></td>
            <td class="luft-text-right luft-update-download">
                <a href="<?php echo get_route('user_edit') . '/' . $staff->id; ?>" class="luft-user-edit hide-on-mobile" >
                    <i class="far fa-edit"></i>
                </a>  
                <a href="<?php echo get_route('download_pdf') . '/' . $staff->id; ?>" class="luft-user-download hide-on-mobile">
                    <i class="fas fa-file-pdf"></i>
                </a> 

                <a href="#" class="luft-extend-table display-on-mobile" ><span class="plus-minus"></span></a>
            </td>     

            <td class="extend-data">        
                <span class="user-list-data">
                    <div>
                        <a href="<?php echo get_route('download_pdf') . '/' . $staff->id; ?>" class="luft-user-download">
                            <i class="fas fa-file-pdf"></i> <span>Ladda ner rapport </span>
                        </a> 
                    </div>
                    <span>
                        <a href="<?php echo get_route('user_edit').'/'. $event->id; ?>"  class="luft-user-edit-btn" >Edit</a> 
                    </span>
                </span>

            </td>     

        </tr>
    <?php endforeach; ?>
    </tbody>
</table>



