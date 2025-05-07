<!-- resources/views/livewire/customer/customer-profile-component.blade.php -->
<div>
    <div class="section-title-01 honmob">
        <div class="bg_parallax image_02_parallax"></div>
        <div class="opacy_bg_02">
            <div class="container">
                <h1>Customer Profile</h1>
                <div class="crumbs">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li>/</li>
                        <li>Profile</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <section class="content-central">
        <div class="content_info">
            <div class="paddings-mini">
                <div class="container">
                    <div class="row portfolioContainer">
                        <div class="col-md-8 col-md-offset-2 profile1">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-md-6">
                                            Profile
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <!-- Display customer image -->
                                            @if($customer && $customer->image)
                                                <img src="{{ asset('images/customers') }}/{{$customer->image}}" width="100%">
                                            @else
                                                <img src="{{ asset('images/customers/default.png') }}" width="100%">
                                            @endif
                                        </div>
                                        <div class="col-md-8">
                                            <h3>Name: {{ Auth::user()->name }}</h3>
                                            <p>{{ $customer->bio ?? 'No information available.' }}</p>
                                            <p><b>Email: </b>{{ Auth::user()->email }}</p>
                                            <p><b>Phone: </b>{{ Auth::user()->phone }}</p>
                                            <p><b>City: </b>{{ $customer->city ?? 'No city specified' }}</p>
                                            <a href="{{ route('customer.edit_profile') }}" class="btn btn-primary pull-right">Edit Profile</a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
