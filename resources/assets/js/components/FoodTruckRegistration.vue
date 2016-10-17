<template>
    <style>
        .alert ul li{
            list-style: none;
        }
        button i{
            top: 0 !important;
        }
        button span{
            padding-left: 10px;
        }
        .highlighted_holderImage{
            height: 100%;
            position:relative;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            text-align: center;
        }

        .highlighted_holder_sm{
            width: 100%;
            height: 180px;
            min-height: 180px;
            min-width: 180px;
            max-width: 180px;
            position: relative;
        }
        .switch-detail{

            line-height: 1.2;
            font-size: 13px;
        }
    </style>
    <div class="container clearfix">
        <div class="col-lg-12">
            <ul class="process-steps process-5 clearfix">
                <li  v-bind:class="{'active': step == 1}">
                    <a href="#" class="i-bordered i-circled divcenter icon-user"></a>
                    <h5>User Account</h5>
                </li>
                <li v-bind:class="{'active': step == 2}">
                    <a href="#" class="i-bordered i-circled divcenter icon-truck"></a>
                    <h5>Truck Info</h5>
                </li>
                <li v-bind:class="{'active': step == 3}">
                    <a href="#" class="i-bordered i-circled divcenter icon-barcode"></a>
                    <h5>Products</h5>
                </li>
                <li v-bind:class="{'active': step == 4}">
                    <a href="#" class="i-bordered i-circled  divcenter icon-wrench"></a>
                    <h5>Settings</h5>
                </li>
                <li v-bind:class="{'active': step == 5}">
                    <a href="#" class="i-bordered i-circled  divcenter icon-globe"></a>
                    <h5>Finish</h5>
                </li>
            </ul>
        </div>
        <div class="col-lg-6 col-lg-offset-3 nobottommargin" v-show="step == 1">


            <h3>Don't have an Account? Register now!</h3>

            <p>Reach new customers and raise your presence everytime you put your wheels on the road - besides enjoy many other features our platform provides (pre-ordering, promotions, invite-customer).<br>
                If you are a customer, <a href="/register">click here</a></p>
            <form id="register-form" name="register-form" class="nobottommargin">

                <div class="alert alert-danger" v-if="errors.length > 0">
                    <p><strong>Whoops!</strong> Something went wrong!</p>
                    <br>
                    <ul>
                        <li v-for="error in errors">
                            {{ error }}
                        </li>
                    </ul>
                </div>
                <div class="col_half">
                    <label for="name">Truck Owner Name:</label>
                    <input  v-on:keyup.enter="nextStep" id="name" type="text" class="form-control" name="name" required autofocus  v-model="name">
                </div>

                <div class="col_half col_last">
                    <label for="email">Email Address:</label>
                    <input  v-on:keyup.enter="nextStep" id="email" type="email" class="form-control" name="email" required  v-model="email">
                </div>

                <div class="clear"></div>

                <div class="col_half">
                    <label for="password">Choose Password:</label>
                    <input  v-on:keyup.enter="nextStep" id="password" type="password" class="form-control" name="password" required v-model="password">
                </div>

                <div class="col_half col_last">
                    <label for="password_confirmation">Re-enter Password:</label>
                    <input  v-on:keyup.enter="nextStep" type="password" id="password_confirmation" name="password_confirmation" value="" class="form-control" v-model="password_confirmation">
                </div>
                <input id="register-type" name="register_type" type="hidden" value="truckers">

                <div class="clear"></div>
                <div class="col-lg-3 col-lg-offset-6 nobottommargin">

                    <button type="button" class="button button-xlarge button-border button-rounded tright" @click="nextStep" v-show="save_1 == false"><span class="hidden-sm hidden-xs hidden-md">Next Step</span><i class="icon-circle-arrow-right"></i></button>
                    <button type="button" class="button button-xlarge button-border button-rounded tright" v-show="save_1 == true"><i class="fa fa-circle-o-notch fa-spin"></i><span class="hidden-sm hidden-xs hidden-md">Validating...</span></button>
                </div>

            </form>

        </div>


        <div class="col-lg-6 col-lg-offset-3 nobottommargin" v-show="step == 2">
            <h2>Tell us about your business...</h2>


            <p>We need to know about your business so we can provide a leaner experience for you so you can enjoy the best of Cloody!</p>
            <form id="register-form" name="register-form" class="nobottommargin">

                <div class="alert alert-danger" v-if="errors.length > 0">
                    <p><strong>Whoops!</strong> Something went wrong!</p>
                    <br>
                    <ul>
                        <li v-for="error in errors">
                            {{ error }}
                        </li>
                    </ul>
                </div>
                <!-- 'name', 'service_type', 'phone', 'identification', 'formal_name', 'status', 'logo', 'status', 'leaving_in' -->
                <div class="row">
                    <div class="col-lg-4 col-lg-offset-4">
                        <a href="javascript:;"  class="thumbnail highlighted_holder_sm" style="margin-bottom: 10px;" @click="avatarUpload">
                          <div v-if="foodtruck.avatar_name != ''" class="highlighted_holderImage" alt="Truck Logo" style="height: 170px; width: 170px; margin:0 auto; display: block;"  v-bind:style="{ 'background-image': 'url(' + foodtruck.avatar + ')' }"></div>
                          <div v-if="foodtruck.avatar_name == ''" class="highlighted_holderImage" alt="Truck Logo" style="height: 170px; width: 170px; margin:0 auto; display: block;"  v-bind:style="{ 'background-image': 'url(images/public/extras/200x200.gif)' }"></div>
                        </a>
                    </div>
                </div>
                <div class="row" style="margin-bottom: 30px;">
                    <div class="col-lg-12" style="text-align: center;">
                        <input  type="file" id="fileInput" v-el:fileInput style="display:none;" @change="avatarChanged" accept="image/png, image/x-png, image/gif, image/jpeg" />
                        <a href="javascript:;" @click="avatarUpload">Select your Foodtruck logo</a><br>
                        <span v-if="foodtruck.avatar_name != ''">Selected file: {{ foodtruck.avatar_name }}</span>
                    </div>
                </div>
                <div class="col_half">
                    <label for="name">Foodtruck Name:</label>
                    <input id="name" type="text" class="form-control" name="name" required autofocus  v-model="foodtruck.name">
                </div>

                <div class="col_half col_last">
                    <label for="service_type">Food Type:</label>
                    <select id="service_type" class="form-control" name="service_type"  v-model="foodtruck.service_type" style="width:100%;">
                    </select>
                </div>


                <div class="col_half">
                    <label for="identification">CNPJ:</label>
                    <input id="identification" type="text" class="form-control cnpj" name="text" required v-model="foodtruck.identification">
                </div>

                <div class="col_half col_last">
                    <label for="phone">Phone:</label>
                    <input id="phone" type="text" class="form-control phone" name="phone" required  v-model="foodtruck.phone">
                </div>
                <div class="col_full">
                    <label for="address">Office Address:</label>
                    <input id="address" type="text" class="form-control" name="text" required v-model="foodtruck.address">
                </div>

                <div class="col_full">
                    <label for="formal_name">Company Official Name:</label>
                    <input type="text" id="formal_name" name="formal_name" value="" class="form-control" v-model="foodtruck.formal_name">
                </div>
                <div class="clear"></div>
                    <div class="col-lg-3 nobottommargin">
                        <button type="button" class="button button-xlarge button-border button-rounded tleft" @click="previousStep" v-show="save_2 == false"><i class="icon-circle-arrow-left"></i><span class="hidden-sm hidden-xs hidden-md">Previous Step</span></button>
                    </div>
                    <div class="col-lg-3 col-lg-offset-3 nobottommargin">

                        <button type="button" class="button button-xlarge button-border button-rounded tright" @click="nextStep" v-show="save_2 == false"><span class="hidden-sm hidden-xs hidden-md">Next Step</span><i class="icon-circle-arrow-right"></i></button>
                        <button type="button" class="button button-xlarge button-border button-rounded tright" v-show="save_2 == true"><i class="fa fa-circle-o-notch fa-spin"></i><span class="hidden-sm hidden-xs hidden-md">Validating...</span></button>
                    </div>
            </form>
        </div>
        <div class="col-lg-6 col-lg-offset-3 nobottommargin" v-show="step == 3">
                <h2>//TODO: Menu Creation/Import</h2>
                <div class="col-lg-3 nobottommargin">
                    <button type="button" class="button button-xlarge button-border button-rounded tleft" @click="previousStep" v-show="save_3 == false"><i class="icon-circle-arrow-left"></i><span class="hidden-sm hidden-xs hidden-md">Previous Step</span></button>
                </div>
                <div class="col-lg-3 col-lg-offset-3 nobottommargin">
                    <button type="button" class="button button-xlarge button-border button-rounded tright" @click="nextStep" v-show="save_3 == false"><span class="hidden-sm hidden-xs hidden-md">Next Step</span><i class="icon-circle-arrow-right"></i></button>
                    <button type="button" class="button button-xlarge button-border button-rounded tright" v-show="save_3 == true"><i class="fa fa-circle-o-notch fa-spin"></i><span class="hidden-sm hidden-xs hidden-md">Validating...</span></button>
                </div>

                    <div class="col-lg-12 nobottommargin" style="text-align: center"><br>
                        <a href="javascript:;" @click="skipStep">Skip this step... </a>
                    </div>
        </div>
        <div class="col-lg-6 col-lg-offset-3 nobottommargin" v-show="step == 4">

                <h2>Almost finishing up...</h2>


                <p>After submitting your foodtruck information we will validate in less than 24h and after that you can start using Cloody with all its feature for 15 days for free.</p>
                <div class="alert alert-danger" v-if="errors.length > 0">
                    <p><strong>Whoops!</strong> Something went wrong!</p>
                    <br>
                    <ul>
                        <li v-for="error in errors">
                            {{ error }}
                        </li>
                    </ul>
                </div>

                <div class="row">
                <div class="col-lg-4">
                    <img src="/images/public/services/iphone3.png">
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="switch" style="margin-top: 5px;line-height: 1.5;">
                                <input id="lets_negotiate" class="switch-toggle switch-toggle-flat" type="checkbox" v-model="foodtruck.lets_negotiate">
                                <label for="lets_negotiate"></label>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <h3  style="margin-bottom: 0;margin-top: 0;">Let's Negotiate</h3>
                            <p class="switch-detail">Allow users to contact you for price negotiation, it's your chance to create opportunities!</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="switch" style="margin-top: 5px;line-height: 1.5;">
                                <input id="delivery_bike" class="switch-toggle switch-toggle-flat" type="checkbox" v-model="foodtruck.delivery_bike">
                                <label for="delivery_bike"></label>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <h3  style="margin-bottom: 0;margin-top: 0;">Bike Delivery</h3>
                            <p class="switch-detail">Enable your business to deliver by bicycle</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="switch" style="margin-top: 5px;line-height: 1.5;">
                                <input id="delivery_motorcycle" class="switch-toggle switch-toggle-flat" type="checkbox" v-model="foodtruck.delivery_motorcycle">
                                <label for="delivery_motorcycle"></label>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <h3  style="margin-bottom: 0;margin-top: 0;">Motorcycle Delivery</h3>
                            <p class="switch-detail">Enable your business to deliver by bicycle</p>
                        </div>
                    </div>
                </div>
                </div>
                <div class="col-lg-3 nobottommargin">
                    <button type="button" class="button button-xlarge button-border button-rounded tleft" @click="previousStep" v-show="save_4 == false"><i class="icon-circle-arrow-left"></i><span class="hidden-sm hidden-xs hidden-md">Previous Step</span></button>
                </div>
                <div class="col-lg-3 col-lg-offset-3 nobottommargin">
                    <button type="button" class="button button-xlarge button-border button-rounded tright button-green" @click="nextStep" v-show="save_4 == false"><span class="hidden-sm hidden-xs hidden-md">Create Account</span><i class="icon-ok"></i></button>
                    <button type="button" class="button button-xlarge button-border button-rounded tright" v-show="save_4 == true"><i class="fa fa-circle-o-notch fa-spin"></i><span class="hidden-sm hidden-xs hidden-md">Validating...</span></button>
                </div>
        </div>

        <div class="col-lg-6 col-lg-offset-3 nobottommargin" v-show="step == 5">

                <h2>Thank you!</h2>
                <p>Your account was successfully created - you can start browsing right away our app. We will be analyzing your profile so we get to know you and we can start sending you clients wherever you are!</p>
                <br>
                <a href="/home" class="button button-desc" style="margin:0 auto;display:block;text-align: center;"><div>Start enjoying Cloody</div><span>Free Forever, Pending Activation</span></a>

        </div>        
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                step: 1,
                errors: [],
                save_1: false,
                save_2: false,
                save_3: false,
                save_4: false,
                foodtruck:{
                    name:'',
                    service_type: null,
                    identification: '',
                    phone: '',
                    address: '',
                    formal_name: '',
                    avatar_name: '',
                    avatar: '',
                    lets_negotiate: false,
                    delivery_bike: false,
                    delivery_motorcycle: false
                },

            };
        },
        ready() {
            var that = this;

            $('#service_type').on('select2:unselecting', function(e) {
                that.foodtruck.service_type = null;
            });

            $('#service_type').on('change',function(){
                that.foodtruck.service_type = $(this).val();
            });

            var SPMaskBehavior = function (val) {
              return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
            },
            spOptions = {
              onKeyPress: function(val, e, field, options) {
                  field.mask(SPMaskBehavior.apply({}, arguments), options);
                }
            };

            $('.phone').mask(SPMaskBehavior, spOptions);
            $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
            this.setSelectComponent();
        },
        methods: {
                setSelectComponent() {
                    var data = [
                            { id: 0, text: 'Hamburguer' }, 
                            { id: 1, text: 'Mexican' }, 
                            { id: 2, text: 'Japanese' }, 
                            { id: 3, text: 'Churros' }, 
                            { id: 4, text: 'Kebab' },
                            { id: 5, text: 'Brewery' },
                            { id: 6, text: 'Soft Drinks' },
                            { id: 7, text: 'Grilled Meat' },
                            { id: 8, text: 'Deserts' },
                            { id: 9, text: 'Thai' },
                            { id: 10, text: 'Coffee' },
                            { id: 11, text: 'Wraps' },
                            { id: 12, text: 'International' },
                            { id: 13, text: 'Vegetarian' },
                            { id: 14, text: 'Healthy Food' },
                            { id: 15, text: 'Sushi' },
                            { id: 16, text: 'Pastel' },
                            { id: 17, text: 'Crepe' },
                            { id: 18, text: 'French Fries' },
                            { id: 19, text: 'Small Portions' },
                            { id: 20, text: 'Wine' },
                            { id: 21, text: 'Barbecue' }, 
                            { id: 22, text: 'Pizza' }, 
                            { id: 23, text: 'Italian' }, 
                            { id: 24, text: 'Alcoholic Beverages' }, 
                            { id: 25, text: 'Bagels' }, 
                    ];
                    
                    $("#service_type").select2({
                        data: data,
                        theme: "bootstrap",
                        placeholder: 'Your food type'
                    });
                },
                avatarUpload() {
                    this.$els.fileinput.click()
                },
                avatarChanged() {
                    if(this.$els.fileinput.files != null)
                    {
                        if(this.$els.fileinput.files.length > 0)
                        {
                            if(this.$els.fileinput.files[0].type == 'image/png' || this.$els.fileinput.files[0].type == 'image/x-png' ||  this.$els.fileinput.files[0].type == 'image/gif' ||  this.$els.fileinput.files[0].type == 'image/jpeg')
                            {
                                this.foodtruck.avatar_name = this.$els.fileinput.files[0].name;
                                var reader = new FileReader();
                                var that = this;
                                reader.onload = function (e) {
                                    that.foodtruck.avatar = e.target.result;
                                }
                                reader.readAsDataURL(this.$els.fileinput.files[0]);
                            }else{
                                this.foodtruck.avatar_name = '';
                                this.foodtruck.avatar = '';
                                this.errors = ['Invalid avatar format, please try again with a different file.'];

                            }
                        }else{
                            this.foodtruck.avatar_name = '';
                            this.foodtruck.avatar = '';
                        }
                    }else{
                        this.foodtruck.avatar_name = '';
                            this.foodtruck.avatar = '';
                    }
                    
                },
                previousStep()
                {
                    --this.step;
                    this.errors = [];
                    this.save_1 = false;
                    this.save_2 = false;
                    this.save_3 = false;
                    this.save_4 = false;
                    this.setSelectComponent();
                },

                skipStep()
                {
                    if(this.step == 3)
                    {
                        ++this.step;
                        this.errors = [];
                        this.save_1 = false;
                        this.save_2 = false;
                        this.save_3 = false;
                        this.save_4 = false;
                    }
                },
                nextStep()
                {
                    var that = this;
                    if(this.step == 1)
                    {
                        this.save_1 = true;
                        this.$http.post('/register-foodtruck/validate', {name: this.name, email: this.email, password: this.password, password_confirmation: this.password_confirmation, register_type: 'trucker'})
                                    .then(response => {
                                that.save_1 = false;
                                that.errors = [];
                                that.step = 2;
                                that.setSelectComponent();
                        })
                        .catch(response => {
                            that.save_1 = false;
                            if (typeof response.data === 'object') {
                            this.errors = _.flatten(_.toArray(response.data));
                        } else {
                            this.errors = ['Something went wrong. Please try again.'];
                        }
                        });
                    }else if(this.step == 2)
                    {

                        if(this.$els.fileinput.files != null)
                        {
                            if(this.$els.fileinput.files.length > 0)
                            {
                                if(this.$els.fileinput.files[0].type == 'image/png' || this.$els.fileinput.files[0].type == 'image/x-png' ||  this.$els.fileinput.files[0].type == 'image/gif' ||  this.$els.fileinput.files[0].type == 'image/jpeg')
                                {
                                    this.save_2 = true;
                                    var files = this.$els.fileinput.files;
                                    var data = new FormData();
                                    data.append('avatar', files[0]);
                                    data.append('foodtruck_name', this.foodtruck.name);
                                    data.append('foodtruck_service_type', this.foodtruck.service_type );
                                    data.append('foodtruck_identification', this.foodtruck.identification );
                                    data.append('foodtruck_phone', this.foodtruck.phone );
                                    data.append('foodtruck_address', this.foodtruck.address );
                                    data.append('foodtruck_formal_name', this.foodtruck.formal_name );
                                    this.$http.post('/register-foodtruck/validate-truck', data)
                                                .then(response => {
                                            that.save_2 = false;
                                            that.errors = [];
                                            that.step = 3;
                                    })
                                    .catch(response => {
                                        that.save_2 = false;
                                        if (typeof response.data === 'object') {
                                        this.errors = _.flatten(_.toArray(response.data));
                                    } else {
                                        this.errors = ['Something went wrong. Please try again.'];
                                    }
                                    });
                                }else{
                                    this.errors = ['Invalid avatar format, please try again with a different file.'];
                                }
                            }else{
                                    this.errors = ['Invalid avatar format, please try again with a different file.'];
                            }
                        }else{
                                    this.errors = ['Invalid avatar format, please try again with a different file.'];
                        }

                    }else if(this.step == 3)
                    {
                        //TODO
                    }else if(this.step == 4)
                    {
                        this.save_4 = true;
                        var files = this.$els.fileinput.files;
                        var data = new FormData();
                        data.append('avatar', files[0]);
                        data.append('foodtruck_name', this.foodtruck.name);
                        data.append('foodtruck_service_type', this.foodtruck.service_type );
                        data.append('foodtruck_identification', this.foodtruck.identification );
                        data.append('foodtruck_phone', this.foodtruck.phone );
                        data.append('foodtruck_address', this.foodtruck.address );
                        data.append('foodtruck_formal_name', this.foodtruck.formal_name );
                        data.append('foodtruck_lets_negotiate', this.foodtruck.lets_negotiate );
                        data.append('foodtruck_delivery_bike', this.foodtruck.delivery_bike );
                        data.append('foodtruck_delivery_motorcycle', this.foodtruck.delivery_motorcycle );
                        data.append('name',this.name);
                        data.append('email',this.email);
                        data.append('password',this.password);
                        data.append('password_confirmation',this.password_confirmation);
                        data.append('register_type','trucker');
                        this.$http.post('/register-foodtruck', data)
                                .then(response => {
                                that.save_4 = false;
                                that.errors = [];
                                that.step = 5;
                        })
                        .catch(response => {
                            that.save_4 = false;
                            if (typeof response.data === 'object') {
                                this.errors = _.flatten(_.toArray(response.data));
                            } else {
                                this.errors = ['Something went wrong. Please try again.'];
                            }
                        });
                    }

                }
        }
    }
</script>
