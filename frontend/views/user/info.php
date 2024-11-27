<?php

use common\models\User;

/** @var User $user */

$this->title = 'User Info';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user_info">
    <div class="field"><span>first name -> </span><?php echo $user->first_name?></div>
    <div class="field"><span>last name -> </span><?php echo $user->last_name?></div>
    <div class="field"><span>date of birth -> </span><?php echo $user->date_of_birth?></div>
    <div class="field"><span>pasport number -> </span><?php echo $user->pasport_number?></div>
    <div class="field"><span>pasport expiry date -> </span><?php echo $user->pasport_expiry_date?></div>
</div>
