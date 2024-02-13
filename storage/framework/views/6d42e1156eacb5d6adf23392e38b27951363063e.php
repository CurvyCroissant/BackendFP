

<?php $__env->startSection('container'); ?>
    <h1>Create Invoice</h1>
    <br>
    <h3>Invoice ID: <?php echo e($cart->id); ?></h3>
    <br>

    <form action="<?php echo e(route('invoice.store', ['cart' => $cart->id])); ?>" method="post" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php $__currentLoopData = $cart->item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($item->quantity > 0): ?>
                <ul>
                    <li>
                        <h5><?php echo e($item->name); ?></h5>
                    </li>
                </ul>

                <div class="mb-2">
                    <label for="category" class="form-label">Category:</label>
                    <input type="text" class="form-control" id="category" name="category"
                        value="<?php echo e($item->category->name); ?>" disabled>
                </div>
                <div class="mb-2">
                    <label for="quantity" class="form-label">Quantity:</label>
                    <select class="form-select" id="quantity" name="quantity" required onchange="updateSubtotal()">
                        <?php for($i = 0; $i <= $item->quantity; $i++): ?>
                            <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="mb-2">
                    <label for="subtotal" class="form-label">Sub-Total:</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp.</span>
                        <input type="text" class="form-control" id="subtotal" name="subtotal"
                            value="<?php echo e($item->price * old('quantity')); ?>" disabled>
                    </div>
                </div>
                <br>
            <?php else: ?>
                <ul>
                    <li>
                        <h5><?php echo e($item->name); ?></h5>
                    </li>
                </ul>
                <h5>Item is out of stock! Please wait for admin to restock.</h5>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <br>
        <div class="mb-2">
            <label for="sender_address" class="form-label">Sender Address:</label>
            <input type="text" class="form-control" id="sender_address" name="sender_address" required>
        </div>
        <div class="mb-2">
            <label for="post_code" class="form-label">Post Code:</label>
            <input type="text" class="form-control" id="post_code" name="post_code" required>
        </div>
        <div class="mb-2">
            <label for="total" class="form-label"><strong>Total:</strong></label>
            <div class="input-group">
                <span class="input-group-text">Rp.</span>
                <input type="text" class="form-control" id="total" name="total" value="<?php echo e($invoice->total); ?>"
                    disabled>
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-dark">Create</button>
    </form>

    <script>
        function updateSubtotal() {
            var quantity = document.getElementById('quantity').value;
            var price = <?php echo e($item->price); ?>;
            var subtotal = quantity * price;
            document.getElementById('subtotal').value = subtotal;
        }
    </script>
    <br>
    <br>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\CODING\(BINUS) Programs\BNCC Class\BackendFP\resources\views/invoiceCreate.blade.php ENDPATH**/ ?>