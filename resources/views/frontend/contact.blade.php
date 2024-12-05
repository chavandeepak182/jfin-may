@extends('frontend.layouts.header')
@section('title', "Financial Services in Pune | Lowest Loan Interest in PCMC - Jfinserv")

@section('content')
<!-- Header Start -->
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Contact Us</h4>    
        </div>
    </div>
<!-- Header End -->


<!-- Contact Start -->
    <div class="container-fluid contact bg-white py-5">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">                
                <h1 class="display-4 mb-4">For Loan Details, Assistance Or Any Queries.</h1>
            </div>
            <div class="row g-5">
                <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="d-flex justify-content-center" >
                        <div class="contact-img-inner p-5">
                            <img src="{{ asset('theme') }}/frontend/img/contact-img.png" class="img-fluid w-100"  alt="Image">
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.4s">
                    <div>   
                        <h4 class="text-primary">Get In Touch With Us.</h4>
                        <p class="mb-4">Want to get in touch? We'd love to hear from you. Here's how you can reach us...</p>
                        <form action="{{ route('enquiry.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control border" id="name" name="name" value="{{ old('name') }}" placeholder="Your Name" required>
                                        <label for="name">Your Name</label>
                                    </div>                                    
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control border" name="email" id="email" value="{{ old('email') }}" placeholder="Your Email" required>
                                        <label for="email">Your Email</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control border" id="contact" name="contact" value="{{ old('contact') }}" placeholder="Phone" required>
                                        <label for="contact">Your Phone</label>
                                    </div>                                
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <select class="form-control border" id="enquiry_type" name="enquiry_type" required>
                                            <option value="" selected disabled hidden>Select Type</option>
                                            <option value="loan" {{ old('enquiry_type') == 'loan' ? 'selected' : '' }}>Loan</option>
                                            <option value="property" {{ old('enquiry_type') == 'property' ? 'selected' : '' }}>Property</option>
                                        </select>
                                        <label for="enquiry_type">Enquiry Type</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control border" id="address" name="address" value="{{ old('address') }}" placeholder="Address" required>
                                        <label for="address">Address</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control border" id="message" name="message" placeholder="Leave a message here" style="height: 120px" required>{{ old('message') }}</textarea>
                                        <label for="message">Message</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-12 wow fadeInUp pt-5" data-wow-delay="0.2s">
                    <div class="rounded">
                        <iframe class="rounded w-100" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3783.239325295986!2d73.87668237465209!3d18.518084069251273!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc2c04fa53aaaab%3A0xe41ec8638ad1532e!2sJfinserv!5e0!3m2!1sen!2sin!4v1723443378612!5m2!1sen!2sin" height="400" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Contact End -->
@endsection