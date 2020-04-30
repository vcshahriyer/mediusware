<?php $__env->startSection('content'); ?>
<div class="container-fluid app-body">
    <h3>Recent Post Sent to buffer</h3>
<div class="row">
    <div class="col-md-12">
        <table class="table table-hover social-accounts"> 
            <form action="<?php echo e(url('history')); ?>" method="get">
                <span class="fa fa-search"></span>
                <input type="text" name="query" placeholder="Search for Group name.." title="Group name">
                <input type="date" name="postDate" data-date-format="YYYY MMMM DD  ">
                <select name="type" id="group">
                    <option value="">All group</option>
                    <option value="upload">Content Upload</option>
                    <option value="curation">Content curation</option>
                    <option value="rss-automation">RSS Automation</option>
                  </select>
                <button>submit</button>
            </form>
            <thead> 
                <tr><th>Group Name</th> <th>Group type</th> <th>Account Name</th> <th>Post text</th> <th>Time</th> </tr> 
            </thead> 
            <tbody>
                <?php if($posts == ""): ?>
                    <tr>
                        <td colspan="5">No Item Found</td>
                    </tr>
                <?php else: ?>
                    <?php $__currentLoopData = $posts->items(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                        <?php echo e($item->name); ?>

                        </td> 
                        <td><?php echo e($item->group_type); ?></td> 
                        <td>
                            <div class="media">
                                <div class="media-left">
                                    <a href="">
                                        <span class="fa fa-<?php echo e($item->type); ?>"></span>
                                        <img width="50" class="media-object img-circle" src="<?php echo e($item->avatar); ?>" alt="Profile">
                                    </a>
                                </div>
                                <div class="media-body media-middle" style="width: 180px;">
                                    <h4 class="media-heading"></h4>
                                </div>
                            </div>
                        </td> 
                        <td>
                            <?php echo e($item->post_text); ?>

                        </td> 
                        <td>
                            <?php echo e($item->sent_at); ?>

                        </td> 
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </tbody> 
        </table>
        <?php echo e($posts->links()); ?>

    </div>
</div>

</div>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>