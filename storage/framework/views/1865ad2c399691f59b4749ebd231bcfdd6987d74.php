<?php
/**
 * Created by PhpStorm.
 * User: dhirajwebappclouds
 * Date: 13/1/17
 * Time: 4:09 PM
 */
?>


<?php $__env->startSection('content'); ?>

    <div class="container">
        <h2>Crossover News RSS Feed</h2>
        <p>
            Welcome to the Crossover News Publications RSS Feed.
        </p>
       <p>
           <?php echo e($feeds); ?>

       </p>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>