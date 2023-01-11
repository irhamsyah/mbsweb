@extends('layouts.page_main')

@section('content')
<section class="mbr-section form1 cid-s9mrYkgQsS" id="form1-27">
    <div class="container">


        <div class="row justify-content-center">
            <div class="title col-12 col-lg-8">
                <h2 class="mbr-section-title align-center pb-3 mbr-fonts-style display-2">
                    REGISTER
                </h2>
                <h3 class="mbr-section-subtitle align-center mbr-light pb-3 mbr-fonts-style display-5"></h3>
            </div>
        </div>
    </div>
    <div class="container">

        <div class="flash-message hideMeBast">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))
                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                @endif
            @endforeach
        </div>

        <div class="row justify-content-center">
            <div class="media-container-column col-lg-8" data-form-type="formoid">
                <!---Formbuilder Form--->
                <form action="/contact" method="POST" class="mbr-form form-with-styler" data-form-title="Mobirise Form">
                    @csrf

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                  <input type="hidden" name="email" data-form-email="true" value="DPqZRTuZN7AsJo+awwTjdlILuegF+2KwyO3tud5du//BK3/IpJMpvGPAApP5MSGSIZoVi6dvOmb5NwPthqeD0b3DzGfcvBu2PnGLHEuKvgvxmvcNxXK/ON0gVQAkUxP8">
                    <div class="dragArea row">
                      <div class="col-md-4  form-group" data-for="xxx">
                        <select class="form-control display-7" id="xxx-form1-27" name="xxx" data-form-field="xxx" style="display:none;">
                          <option value="#" selected="true" disabled="disabled">--- xxx ---</option>
                        </select>
                      </div>
                    </div>
                    <div class="dragArea row">
                        <div class="col-md-4  form-group" data-for="email">
                            <label for="username-form1-27" class="form-control-label mbr-fonts-style display-7">Username *</label>
                            <input type="text" name="username" data-form-field="Username" required="required" class="form-control display-7" id="username-form1-27">
                        </div>
                        <div data-for="password" class="col-md-4  form-group">
                            <label for="password-form1-27" class="form-control-label mbr-fonts-style display-7">Password *</label>
                            <input type="password" name="password" data-form-field="Password" required="required" class="form-control display-7" id="password-form1-27">
                        </div>
                        <div data-for="passwordconf" class="col-md-4  form-group">
                            <label for="passwordconf-form1-27" class="form-control-label mbr-fonts-style display-7">Confirm Password *</label>
                            <input type="password" name="passwordconf" data-form-field="Passwordconf" required="required" class="form-control display-7" id="passwordconf-form1-27">
                        </div>
                        <div class="col-md-4  form-group" data-for="entity">
                          <label for="entity-form1-27" class="form-control-label mbr-fonts-style display-7">Entity *</label>
                          <select class="form-control display-7" id="entity-form1-27" name="entity" data-form-field="entity" required="required">
                            <option value="#" selected="true" disabled="disabled">--- Select Entity ---</option>
                            @foreach($entitys as $entity)
                            <option value="{{ $entity->id }}">{{ $entity->entity_name }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-md-4  form-group" data-for="company">
                            <label for="company-form1-27" class="form-control-label mbr-fonts-style display-7">Company Name *</label>
                            <input type="text" name="company" data-form-field="company" required="required" class="form-control display-7" id="company-form1-27">
                        </div>
                        <div class="col-md-4  form-group" data-for="account">
                            <label for="account-form1-27" class="form-control-label mbr-fonts-style display-7">Account Name</label>
                            <input type="text" name="account" disabled="disabled" data-form-field="account" class="form-control display-7" id="account-form1-27">
                        </div>
                        <div data-for="address" class="col-md-8 form-group">
                            <label for="address-form1-27" class="form-control-label mbr-fonts-style display-7">Address *</label>
                            <input type="text" name="address" data-form-field="address" required="required" class="form-control display-7" id="address-form1-27">
                        </div>
                        <div data-for="postal" class="col-md-4  form-group">
                            <label for="postal-form1-27" class="form-control-label mbr-fonts-style display-7">Postal Code</label>
                            <input type="text" name="postal" data-form-field="postal" class="form-control display-7" id="postal-form1-27">
                        </div>
                        <div class="col-md-4  form-group" data-for="city">
                          <label for="city-form1-27" class="form-control-label mbr-fonts-style display-7">City *</label>
                          <input type="text" name="city" data-form-field="city" class="form-control display-7" required="required" id="city-form1-27">
                        </div>
                        <div class="col-md-4  form-group" data-for="province">
                            <label for="province-form1-27" class="form-control-label mbr-fonts-style display-7">Province *</label>
                            <input type="text" name="province" data-form-field="Province" required="required" class="form-control display-7" id="province-form1-27">
                        </div>
                        <div class="col-md-4  form-group" data-for="email">
                            <label for="email-form1-27" class="form-control-label mbr-fonts-style display-7">Email *</label>
                            <input type="email" name="email" data-form-field="Email" required="required" class="form-control display-7" id="email-form1-27">
                        </div>
                        <div data-for="mphone" class="col-md-4  form-group">
                            <label for="mphone-form1-27" class="form-control-label mbr-fonts-style display-7">Mobile Phone *</label>
                            <input type="text" name="mphone" data-form-field="mphone" required="required" class="form-control display-7" id="mphone-form1-27">
                        </div>
                        <div data-for="phone" class="col-md-4  form-group">
                            <label for="phone-form1-27" class="form-control-label mbr-fonts-style display-7">Phone</label>
                            <input type="tel" name="phone" data-form-field="phone" class="form-control display-7" id="phone-form1-27">
                        </div>
                        <div data-for="fax" class="col-md-4  form-group">
                            <label for="fax-form1-27" class="form-control-label mbr-fonts-style display-7">Fax</label>
                            <input type="tel" name="fax" data-form-field="fax" class="form-control display-7" id="fax-form1-27">
                        </div>
                        <!-- <div class="col-md-4  form-group" data-for="npwp">
                            <label for="npwp-form1-27" class="form-control-label mbr-fonts-style display-7">NPWP</label>
                            <input type="text" name="npwp" data-form-field="npwp" class="form-control display-7" id="npwp-form1-27">
                        </div>
                        <div data-for="npwpaddress" class="col-md-8 form-group">
                            <label for="npwpaddress-form1-27" class="form-control-label mbr-fonts-style display-7">NPWP Address *</label>
                            <input type="text" name="npwpaddress" data-form-field="npwpaddress" required="required" class="form-control display-7" id="npwpaddress-form1-27">
                        </div> -->
                        <div class="col-md-12 input-group-btn align-center"><button type="submit" class="btn btn-primary btn-form display-4">SUBMIT</button></div>
                    </div>
                    @csrf
                </form><!---Formbuilder Form--->
            </div>
        </div>
    </div>
</section>


@endsection
