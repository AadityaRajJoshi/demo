<table class="luft-table">
    <thead>
        <tr>
          <th class="luft-user-id"><?php thead('id'); ?>  </th>
          <th><?php thead('label_name', 'username'); ?></th>
          <th><?php echo get_msg( 'work_time' ) ?></th>
          <th class="luft-update-download"></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($staffs as $key => $staff): ?>
        <?php $worktime = get_staff_worktime( $staff->id ) ?>
        <tr>
            <td><?php echo $key+1; ?></td>
            <td><?php echo $staff->username; ?></td>
            <td> <?php echo $worktime ? $worktime : get_msg( 'no_event_assigned' ) ?></td>
            <td class="luft-text-right">
                <a href="<?php echo get_route('user_edit') . '/' . $staff->id; ?>" class="luft-user-edit" >
                    <i class="far fa-edit"></i>
                </a>
                <?php if($worktime) :?>
                    <a href="<?php echo get_route('download_pdf') . '/' . $staff->id; ?>" class="luft-user-download">
                        <i class="fas fa-file-pdf"></i>
                    </a> 
                <?php endif;?>
            </td>     
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>