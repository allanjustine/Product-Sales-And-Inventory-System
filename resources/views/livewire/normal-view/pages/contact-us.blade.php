<div>
    <h3 class="mb-4 mt-3">Contact Us</h3>
    <hr>
    <h5 class="text-center">Welcome to our contact us page! We value your feedback, comments, and questions, and
        we're committed
        to providing you with the best possible customer service. Whether you have a question about our
        products or services, want to report a problem, or just want to share your thoughts, we're here to
        help. Please use the form below to get in touch with us, and we'll get back to you as soon as
        possible. Thank you for your interest in our company, and we look forward to hearing from you!</h5>
    <br>
    <hr>
    <div class="container mt-4">
        <div class="card rounded elevation-3 col-md-6 offset-md-3">
            <div class="card-header">
                <h5 class="text-center mt-3 mb-3">Please fill out the form below to get in touch with us.</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div>
                        <form wire:submit.prevent="submit">
                            @csrf
                            <label for="name">Name:</label>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="name" placeholder="Enter your name"
                                    wire:model.defer="name">
                                <label for="name">Name:</label>
                            </div>
                            @error('name')
                                <span class="text-danger">*{{ $message }}</span>
                            @enderror
                            <br>
                            <label for="email">Email address:</label>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="email" placeholder="Enter email"
                                    wire:model.defer="email">
                                <label for="email">Email address:</label>
                            </div>
                            @error('email')
                                <span class="text-danger">*{{ $message }}</span>
                            @enderror
                            <br>
                            <div class="form-group mb-3">
                                <label for="message">Message:</label>
                                <textarea class="form-control" id="message" rows="5" placeholder="Message..." wire:model.defer="message"></textarea>
                            </div>
                            @error('message')
                                <span class="text-danger">*{{ $message }}</span>
                            @enderror
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>