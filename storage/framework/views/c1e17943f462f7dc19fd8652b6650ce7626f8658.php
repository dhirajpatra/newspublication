<?php
/**
 * Created by PhpStorm.
 * User: dhirajwebappclouds
 * Date: 14/1/17
 * Time: 7:56 AM
 */
?>


<?php $__env->startSection('content'); ?>
    <div id="container">
        <?php if(isset($success)): ?>
            <div class="alert alert-success"> <?php echo e($success); ?> </div>
        <?php endif; ?>
        <div class="page-header">&nbsp;</div>
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <h1>Create News</h1>

            <?php echo $__env->make('layouts.partials.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <?php echo e(Form::open(['route' => 'news_path', 'files'=>true])); ?>

            <?php echo csrf_field(); ?>

            <!--- Username Field --->
            <?php echo e(Form::hidden('news_reporter_id', Auth::user()->id)); ?>

                <!--- Photo Field --->
                <div class="form-group">
                <?php echo Form::label('image', 'Photo:'); ?>

                <?php echo Form::file('image'); ?>

                </div>
                <!--- Title Field --->
                <div class="form-group">
                    <?php echo e(Form::label('title', 'Title:')); ?>

                    <?php echo e(Form::text('title', null, ['class' => 'form-control', 'required' => 'required'])); ?>

                </div>
                <!--- Details Field --->
                <div class="form-group">
                    <?php echo e(Form::label('details', 'Details:')); ?>

                    <?php echo e(Form::textarea('details', '', ['class' => 'form-control', 'required' => 'required', 'size' => '30x10'])); ?>

                </div>
                <!--- Save Field --->
                <div class="form-group">
                    <?php echo e(Form::submit('Save', ['class' => 'btn btn-large btn-primary form-control'])); ?>

                </div>
                <?php echo e(Form::close()); ?>

            </div>
        </div>
<?php $__env->stopSection(); ?>
    </div>
<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>