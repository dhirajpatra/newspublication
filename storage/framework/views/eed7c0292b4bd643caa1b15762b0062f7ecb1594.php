<?php
/**
 * Created by PhpStorm.
 * User: dhirajwebappclouds
 * Date: 13/1/17
 * Time: 4:12 PM
 */
?>


<?php $__env->startSection('content'); ?>
    <div id="container">
        <div id="row">&nbsp;</div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">

            <h1>Sign In!</h1>

        <?php echo $__env->make('layouts.partials.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <?php echo e(Form::open(['route' => 'login_path'])); ?>


        <!--- Username Field --->
            <div class="form-group">
                <?php echo e(Form::label('username', 'Username:')); ?>

                <?php echo e(Form::text('username', null, ['class' => 'form-control', 'required' => 'required'])); ?>

            </div>
            <!--- Password Field --->
            <div class="form-group">
                <?php echo e(Form::label('password', 'Password:')); ?>

                <?php echo e(Form::password('password', ['class' => 'form-control', 'required' => 'required'])); ?>

            </div>
            <!--- Sign In Field --->
            <div class="form-group">
                <?php echo e(Form::submit('Sign In', ['name' => 'login', 'class' => 'btn btn-primary'])); ?>

            </div>
            <?php echo e(Form::close()); ?>

        </div>
    </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>