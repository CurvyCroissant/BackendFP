<?php $__env->startSection('title', __('Forbidden')); ?>
<?php $__env->startSection('code', '403'); ?>
<?php $__env->startSection('message', __($exception->getMessage() ?: 'Forbidden')); ?>

<?php echo $__env->make('errors::minimal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Asus ROG G14\coding\Praetorian\Laravel\lntclass_a\vendor\laravel\framework\src\Illuminate\Foundation\Exceptions/views/403.blade.php ENDPATH**/ ?>