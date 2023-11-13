<?php
$title = "Contact Us";
include("../templates/template_top.php"); ?>

<div class="container col-10">
    <h1 class="text-center">Contact Us</h1>
    <div>
        <sub class="required">Red stars are required</sub>
    </div>
    <form
            action="contact_receipt.php"
            method="post"
            id="contact-form"
            class="row gy-3 justify-content-evenly"
    >
        <div class="form-group">
            <label class="required" for="name">Name</label>
            <input
                    type="text"
                    class="form-control"
                    id="name"
                    name="name"
                    required
                    placeholder="First Last"
            >
        </div>

        <div class="form-group">
            <label class="required" for="email">Email</label>
            <input
                    type="email"
                    class="form-control"
                    id="email"
                    name="email"
                    required
                    placeholder="Eg. example@email.com"
            >
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input
                    type="tel"
                    class="form-control"
                    id="phone"
                    name="phone"
                    placeholder="Eg. xxx-xxx-xxxx"
            >
        </div>

        <div class="form-group">
            <label class="required" for="message">Message</label>
            <textarea
                    class="form-control"
                    id="message"
                    name="message"
                    rows="4"
                    required
                    placeholder="Your message"
            ></textarea>
        </div>

        <button type="submit" class="btn shadow-lg btn-success col-4" id="contact-form-btn"><strong>Send</strong>
        </button>
    </form>
</div>

<?php include("../templates/template_bottom.php");//leave in place for standard mobile sized bottom menu includes the closing tags
