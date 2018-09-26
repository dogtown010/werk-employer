@extends('main')
@section('content')

    <div class="grid-container" style="margin-top: 50px;">
        <div class="grid-x grid-padding-x" style="padding-bottom: 10px;">
            <div class="large-12 cell">
                <h2 style="text-align: center;">Edit Client</h2>
            </div>
        </div>         

        <div class="grid-x grid-padding-x">
            <div class="auto cell"></div>
            <div class="large-6 cell">
                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <form action="{{url('processEdit')}}" method="POST" data-abide novalidate>
                    @csrf
                    <input type="hidden" name="id" value="{{$employers->ID}}">
                    <div data-abide-error class="alert callout" style="display: none;">
                        <p><i class="fi-alert"></i> There are some errors in your form.</p>
                    </div>
                    <div class="grid-container">
                        <div class="grid-x grid-padding-x">
                            <div class="large-12 cell">
                                <span class="error-validation">{{isset($errors) ? $errors->first('name') : ''}}</span>
                                <input type="text" name="name" placeholder="Company Name" required value="{{ $employers->CompanyName }}">
                                <span class="form-error">Yo, you had better fill this out, it's required.</span>
                            </div>
                        </div>

                        <div class="grid-x grid-padding-x">
                            <div class="large-12 cell">
                                <span class="error-validation">{{isset($errors) ? $errors->first('address') : ''}}</span>
                                <input type="text" name="address" placeholder="Address" required value="{{ $employers->CompanyAddress }}">
                                <span class="form-error">Yo, you had better fill this out, it's required.</span>
                            </div>
                        </div>

                        <div class="grid-x grid-padding-x">
                            <div class="large-12 cell">
                                <span class="error-validation">{{isset($errors) ? $errors->first('industry') : ''}}</span>
                                <select name="industry" required>
                                    <option value="{{ $employers->Industry }}" selected>{{ $employers->Industry }}</option>
                                    <option value="Accounting / Audit / Tax Services">Accounting / Audit / Tax Services</option>
                                    <option value="Advertising / Marketing / Promotion / PR">Advertising / Marketing / Promotion / PR</option>
                                    <option value="Aerospace / Aviation / Airline">Aerospace / Aviation / Airline</option>
                                    <option value="Agricultural / Plantation / Poultry / Fisheries">Agricultural / Plantation / Poultry / Fisheries</option>
                                    <option value="Apparel">Apparel</option>
                                    <option value="Architectural Services / Interior Designing">Architectural Services / Interior Designing</option>
                                    <option value="Arts / Design / Fashion">Arts / Design / Fashion</option>
                                    <option value="Automobile / Automotive Ancillary / Vehicle">Automobile / Automotive Ancillary / Vehicle</option>
                                    <option value="Banking / Financial Services">Banking / Financial Services</option>
                                    <option value="BioTechnology / Pharmaceutical / Clinical research">BioTechnology / Pharmaceutical / Clinical research</option>
                                    <option value="Call Center / IT Enabled Services">Call Center / IT Enabled Services</option>
                                    <option value="Chemical / Fertilizers / Pesticides">Chemical / Fertilizers / Pesticides</option>
                                    <option value="Computer / Information Technology (Hardware)">Computer / Information Technology (Hardware)</option>
                                    <option value="Computer / Information Technology (Software)">Computer / Information Technology (Software)</option>
                                    <option value="Construction / Building / Engineering">Construction / Building / Engineering</option>
                                    <option value="Consulting (Business & Management)">Consulting (Business & Management)</option>
                                    <option value="Consulting (IT, Science, Engineering & Technical)">Consulting (IT, Science, Engineering & Technical)</option>
                                    <option value="Consumer Products / FMCG">Consumer Products / FMCG</option>
                                    <option value="Education">Education</option>
                                    <option value="Electrical & Electronics">Electrical & Electronics</option>
                                    <option value="Entertainment / Media">Entertainment / Media</option>
                                    <option value="Environment / Health / Safety">Environment / Health / Safety</option>
                                    <option value="Food & Beverage / Catering / Restauran">Food & Beverage / Catering / Restaurant</option>
                                    <option value="General & Wholesale Trading">General & Wholesale Trading</option>
                                    <option value="Grooming / Beauty / Fitness">Grooming / Beauty / Fitness</option>
                                    <option value="Healthcare / Medical">Healthcare / Medical</option>
                                    <option value="Heavy Industrial / Machinery / Equipment">Heavy Industrial / Machinery / Equipment</option>
                                    <option value="Hotel / Hospitality">Hotel / Hospitality</option>
                                    <option value="Insurance">Insurance</option>
                                    <option value="Law / Legal">Law / Legal</option>
                                    <option value="Manufacturing / Production">Manufacturing / Production</option>
                                    <option value="Mining">Mining</option>
                                    <option value="Non-Profit Organisation / Social Services / NGO">Non-Profit Organisation / Social Services / NGO</option>
                                    <option value="Oil / Gas / Petroleum">Oil / Gas / Petroleum</option>
                                    <option value="Printing / Publishing">Printing / Publishing</option>
                                    <option value="Property / Real Estate">Property / Real Estate</option>
                                    <option value="R&D">R&D</option>
                                    <option value="Repair and Maintenance Services">Repair and Maintenance Services</option>
                                    <option value="Retail / Merchandise">Retail / Merchandise</option>
                                    <option value="Science & Technology">Science & Technology</option>
                                    <option value="Semiconductor / Wafer Fabrication">Semiconductor / Wafer Fabrication</option>
                                    <option value="Sports">Sports</option>
                                    <option value="Stockbroking / Securities">Stockbroking / Securities</option>
                                    <option value="Telecommunication">Telecommunication</option>
                                    <option value="Textiles / Garment">Textiles / Garment</option>
                                    <option value="Tobacco">Tobacco</option>
                                    <option value="Transportation / Logistics">Transportation / Logistics</option>
                                    <option value="Travel / Tourism">Travel / Tourism</option>
                                    <option value="Utilities / Power">Utilities / Power</option>
                                    <option value="Wood / Fiber / Paper">Wood / Fiber / Paper</option>
                                    <option value="Others">Others</option>
                                </select>
                                <span class="form-error">Yo, you had better fill this out, it's required.</span>
                            </div>
                        </div>

                        <div class="grid-x grid-padding-x">
                            <div class="large-12 cell">
                                <span class="error-validation">{{isset($errors) ? $errors->first('classification') : ''}}</span>
                                <select name="classification" required>
                                    <option value="{{ $employers->Classification }}" selected>{{ $employers->Classification }}</option>
                                    <option value="Company">Company</option>
                                    <option value="Partner - Company">Partner - Company</option>
                                    <option value="Partner - Campus">Partner - Campus</option>
                                </select>
                                <span class="form-error">Yo, you had better fill this out, it's required.</span>
                            </div>
                        </div>

                        <div class="grid-x grid-padding-x">
                            <div class="large-12 cell">
                                <span class="error-validation">{{isset($errors) ? $errors->first('classification') : ''}}</span>
                                <input type="text" name="person" placeholder="Contact Person" required value="{{ $employers->ContactPerson }}">
                                <span class="form-error">Yo, you had better fill this out, it's required.</span>
                            </div>
                        </div>

                        <div class="grid-x grid-padding-x">
                            <div class="large-12 cell">
                                <span class="error-validation">{{isset($errors) ? $errors->first('position') : ''}}</span>
                                <input type="text" name="position" placeholder="Position" required value="{{ $employers->Position }}">
                                <span class="form-error">Yo, you had better fill this out, it's required.</span>
                            </div>
                        </div>

                        <div class="grid-x grid-padding-x">
                            <div class="large-12 cell">
                                <span class="error-validation">{{isset($errors) ? $errors->first('lnumber') : ''}}</span>
                                <input type="text" name="lnumber" placeholder="Landline number" required value="{{ $employers->ContactNumberLandline }}">
                                <span class="form-error">Yo, you had better fill this out, it's required.</span>
                            </div>
                        </div>

                        <div class="grid-x grid-padding-x">
                            <div class="large-12 cell">
                                <input type="text" name="mnumber" placeholder="Mobile number" value="{{ $employers->ContactNumberMobile }}">
                            </div>
                        </div>

                        <div class="grid-x grid-padding-x">
                            <div class="large-12 cell">
                                <span class="error-validation">{{isset($errors) ? $errors->first('email') : ''}}</span>
                                <input type="email" name="email" placeholder="Email Number" required value="{{ $employers->EmailAddress }}">
                                <span class="form-error">Yo, you had better fill this out, it's required.</span>
                            </div>
                        </div>

                        <div class="grid-x grid-padding-x">
                            <div class="large-12 cell">
                                <button class="button" type="submit" value="Submit">Submit</button>
                                <a class="button alert" href="{{url('/')}}">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="auto cell"></div>
        </div>
    </div>        

@endsection