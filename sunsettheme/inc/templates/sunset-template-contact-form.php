<form id="sunsetContactForm" action="#" method="post" data-url="<?php echo admin_url('admin-ajax.php'); ?>">

    <div class="form-group">
        <input type="text" class="form-control" name="name" id="name" placeholder="Your Name" required="required">
    </div>

    <div class="form-group">
        <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required="required">
    </div>

    <div class="form-group">
        <textarea class="form-control" name="message" id="message" placeholder="Your Message" required="required"></textarea>
    </div>

    <button type="submit" class="btn btn-default">Submit</button>

</form>
