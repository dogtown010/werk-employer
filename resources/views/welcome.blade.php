@extends('main')
@section('content')
    <div class="grid-container" style="margin-top: 50px; margin-bottom: 50px;">
        <div class="grid-x grid-padding-x">
            <div class="large-12 cell">
                <h2>Client Database</h2>
            </div>
        </div>

        <div class="grid-x grid-padding-x">
            <div class="large-12 cell">
                <button class="button" data-open="add">Add Client</button>
                <a class="button success" href="{{url('export')}}">Export Database</a>
                <button class="button" data-open="import">Import</button>

                <form action="{{url('search')}}" method="POST" data-abide novalidate>
                    @csrf
                    <div class="input-group">
                        <input class="input-group-field" type="text" name="search" placeholder="Seach" required>
                        <div class="input-group-button">
                            <button class="button" type="submit" value="Submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="grid-x grid-padding-x">
            <div class="large-12 cell">
                @if (session('status'))
                    <div class="callout" data-closable="fade-out">
                      <button class="close-button" data-close>&times;</button>
                      <p style="font-weight: bold; font-size: 20px;">{{ session('status') }}</p>
                    </div>
                @endif
                <table class="hover">
                    <thead>
                        <tr>
                            <th width="200">Company</th>
                            <th>Address</th>
                            <th width="150">Industry</th>
                            <th width="150">Classification</th>
                            <th>Contact Person</th>
                            <th>Position</th>
                            <th>Landline Number</th>
                            <th>Mobile Number</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($employers))
                            @foreach($employers as $clients)
                            <tr>
                               <td>{{$clients->CompanyName}}</td>
                               <td>{{$clients->CompanyAddress}}</td>
                               <td>{{$clients->Industry}}</td>
                               <td>{{$clients->Classification}}</td>
                               <td>{{$clients->ContactPerson}}</td>
                               <td>{{$clients->Position}}</td>
                               <td>{{$clients->ContactNumberLandline}}</td>
                               <td>{{$clients->ContactNumberMobile}}</td>
                               <td>{{$clients->EmailAddress}}</td> 
                               <td style="text-align: center;">
                                   <a href="{{url('edit'.'/'.$clients->ID)}}">EDIT</a><br>
                                   <a href="{{url('delete'.'/'.$clients->ID)}}">DELETE</a>
                               </td>
                            </tr>
                        @endforeach
                        @else
                            <tr>
                                <td colspan="10" style="text-align: center;">
                                    <p style="font-weight: bold;">No Records</p>
                                </td>
                            </tr>
                        @endif
                        
                    </tbody>
                </table>
                {{ $employers->links() }}
            </div>
        </div>
    </div>        

    <div class="reveal" id="add" data-reveal data-animation-in="fade-in fast" data-animation-out="fade-out fast">
        <div class="grid-x grid-padding-x">
            <div class="large-12 cell">
                <h2>Add Client</h2>
            </div>
        </div>
        <form action="{{url('add')}}" method="POST" data-abide novalidate>
            @csrf
            <div data-abide-error class="alert callout" style="display: none;">
                <p><i class="fi-alert"></i> There are some errors in your form.</p>
            </div>
            <div class="grid-container">
                <div class="grid-x grid-padding-x">
                    <div class="large-12 cell">
                        <span class="error-validation">{{isset($errors) ? $errors->first('name') : ''}}</span>
                        <input type="text" name="name" placeholder="Company Name" required value="{{ old('name') }}">
                        <span class="form-error">Yo, you had better fill this out, it's required.</span>
                    </div>
                </div>

                <div class="grid-x grid-padding-x">
                    <div class="large-12 cell">
                        <span class="error-validation">{{isset($errors) ? $errors->first('address') : ''}}</span>
                        <input type="text" name="address" placeholder="Address" required value="{{ old('address') }}">
                        <span class="form-error">Yo, you had better fill this out, it's required.</span>
                    </div>
                </div>

                <div class="grid-x grid-padding-x">
                    <div class="large-12 cell">
                        <span class="error-validation">{{isset($errors) ? $errors->first('industry') : ''}}</span>
                        <select name="industry" required>
                            <option value="{{old('industry')}}" selected disabled>{{ old('industry') ? old('industry') : 'Industry Type'}}</option>
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
                            <option value="{{old('classification')}}" selected disabled>{{ old('classification') ? old('classification') : 'Classification Type'}}</option>
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
                        <input type="text" name="person" placeholder="Contact Person" required value="{{ old('person') }}">
                        <span class="form-error">Yo, you had better fill this out, it's required.</span>
                    </div>
                </div>

                <div class="grid-x grid-padding-x">
                    <div class="large-12 cell">
                        <span class="error-validation">{{isset($errors) ? $errors->first('position') : ''}}</span>
                        <input type="text" name="position" placeholder="Position" required value="{{ old('position') }}">
                        <span class="form-error">Yo, you had better fill this out, it's required.</span>
                    </div>
                </div>

                <div class="grid-x grid-padding-x">
                    <div class="large-12 cell">
                        <span class="error-validation">{{isset($errors) ? $errors->first('lnumber') : ''}}</span>
                        <input type="text" name="lnumber" placeholder="Landline number" required value="{{ old('lnumber') }}">
                        <span class="form-error">Yo, you had better fill this out, it's required.</span>
                    </div>
                </div>

                <div class="grid-x grid-padding-x">
                    <div class="large-12 cell">
                        <input type="text" name="mnumber" placeholder="Mobile number" value="{{ old('mnumber') }}">
                    </div>
                </div>

                <div class="grid-x grid-padding-x">
                    <div class="large-12 cell">
                        <span class="error-validation">{{isset($errors) ? $errors->first('email') : ''}}</span>
                        <input type="email" name="email" placeholder="Email Number" required value="{{ old('email') }}">
                        <span class="form-error">Yo, you had better fill this out, it's required.</span>
                    </div>
                </div>

                <div class="grid-x grid-padding-x">
                    <div class="large-12 cell">
                        <button class="button" type="submit" value="Submit">Submit</button>
                    </div>
                </div>
            </div>
        </form>


      <button class="close-button" data-close aria-label="Close modal" type="button">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>


    <div class="reveal" id="import" data-reveal data-animation-in="fade-in fast" data-animation-out="fade-out fast">
        <div class="grid-x grid-padding-x">
            <div class="large-12 cell">
                <h2>Import CSV File</h2>
                <p>Kindly follow this format. Click <a href="{{url('format')}}">here</a> to download format</p>
            </div>
        </div>
        <form action="{{url('processImport')}}" method="POST" enctype="multipart/form-data" data-abide novalidate>
            @csrf
            <div data-abide-error class="alert callout" style="display: none;">
                <p><i class="fi-alert"></i> There are some errors in your form.</p>
            </div>
            <div class="grid-container">
                <div class="grid-x grid-padding-x">
                    <div class="large-12 cell">
                        <input type="file" name="file" required >
                        <span class="form-error">Yo, you better select a CSV file, it's required.</span>
                    </div>
                </div>

                <div class="grid-x grid-padding-x">
                    <div class="large-12 cell">
                        <button class="button" type="submit" value="Submit">Submit</button>
                    </div>
                </div>
            </div>
        </form>


      <button class="close-button" data-close aria-label="Close modal" type="button">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
@endsection


@section('script')
    <script>
      $(document).foundation();

      function getQueryVariable(variable)
      {
             var query = window.location.search.substring(1);
             var vars = query.split("&");
             for (var i=0;i<vars.length;i++) {
                     var pair = vars[i].split("=");
                     if(pair[0] == variable){return pair[1];}
             }
             return(false);
      }

      if (window.location.search) {
           var showModal = getQueryVariable('validate');
           if (showModal == 'yes') {
                $('#add').foundation('open');
           }
      }
    </script>
@endsection