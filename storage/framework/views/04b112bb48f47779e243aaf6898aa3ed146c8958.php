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
        <h2>Crossover News Publications</h2>
        <p>
            Welcome to the Crossover News Publications application.
        </p>
        <?php if(Session::has('msg')): ?>
            <div class="alert alert-info">
                <a class="close" data-dismiss="alert">×</a>
                <strong>Heads Up!</strong> <?php echo Session::get('msg'); ?>

            </div>
        <?php endif; ?>
        <table style="width:100%; border-spacing: 5px; border-collapse: separate;">
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Details</th>
                <th>Reporter</th>
                <th>Published</th>
                <th>Delete</th>
            </tr>
        <?php $__currentLoopData = $newsList['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
            <tr>
                <td width="15%"><img src="<?php echo '/newsimages/'.$news['news_photo']; ?>" width="100" height="100"></td>
                <td width="15%"><?php echo e($news['news_title']); ?></td>
                <td width="45%"><?php echo e($news['news_details']); ?></td>
                <td width="10%"><?php echo e($news['user']['username']); ?></td>
                <td width="10%"><?php echo e(Carbon\Carbon::parse($news['created_at'])->format('d-m-Y')); ?></td>
                <td>
                        <?php if(Auth::check()): ?>
                    <?php echo e(Form::open(['route' => ['news_delete', Crypt::encrypt($news['news_id'])], 'method' => 'delete'])); ?>

                    <?php echo e(Form::hidden('news_id', $news['news_id'])); ?>

                    <?php echo e(Form::submit('Delete', ['class' => 'btn btn-warning form-control'])); ?>

                    <?php echo e(Form::close()); ?>

                        <?php else: ?>
                        Login required
                        <?php endif; ?>
                </td>
            </tr>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        </table>
        <?php if(Auth::check()): ?>
            <?php echo e(link_to_route('news_path', 'Create News', null, ['class' => 'btn btn-lg btn-primary'])); ?>

        <?php else: ?>
            <?php echo e(link_to_route('register_path', 'Sign Up', null, ['class' => 'btn btn-lg btn-primary'])); ?>

        <?php endif; ?>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>