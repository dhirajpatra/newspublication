<?php
/**
 * Created by PhpStorm.
 * User: dhirajwebappclouds
 * Date: 13/1/17
 * Time: 4:11 PM
 */
?>


<?php $__env->startSection('content'); ?>
    <div class="page-header">&nbsp;</div>
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <h1>Register</h1>

        <?php echo $__env->make('layouts.partials.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <?php echo e(Form::open(['route' => 'register_path'])); ?>

        <!--- Username Field --->
            <div class="form-group">
                <?php echo e(Form::label('username', 'Username:')); ?>

                <?php echo e(Form::text('username', null, ['class' => 'form-control', 'required' => 'required'])); ?>

            </div>
            <!--- Email Field --->
            <div class="form-group">
                <?php echo e(Form::label('email', 'Email:')); ?>

                <?php echo e(Form::text('email', null, ['class' => 'form-control', 'required' => 'required'])); ?>

            </div>
            <!--- Password Field --->
            <div class="form-group">
                <?php echo e(Form::label('password', 'Password:')); ?>

                <?php echo e(Form::password('password', ['class' => 'form-control', 'required' => 'required'])); ?>

            </div>
            <!--- Confirm Password Field --->
            <div class="form-group">
                <?php echo e(Form::label('password_confirmation', 'Confirm Password:')); ?>

                <?php echo e(Form::password('password_confirmation', ['class' => 'form-control', 'required' => 'required'])); ?>

            </div>
            <!--- Sign Up Field --->
            <div class="form-group">
                <?php echo e(Form::submit('Sign Up', ['name' => 'signup', 'class' => 'btn btn-primary'])); ?>

            </div>
            <?php echo e(Form::close()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>