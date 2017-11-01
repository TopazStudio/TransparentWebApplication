<template>
    <footer class="fly-footer">
        <div class="footer-upper">
            <div class="footer-contact">
                <!--CONTACT FORM-->
                <p style="  margin: 10px;
                            font-size: 20px;
                            font-weight: 900;
                            letter-spacing: 5px;
                            text-align: center;
                            color: white;">CONTACT US</p>
                <el-form ref="contactForm" class="contact-form" :model="form" :rules="rules">
                    <div class="contact-content">
                        <el-form-item class="input-field col s12" prop="email">
                            <el-input type="email" placeholder="Email" v-model="form.email" auto-complete="off"></el-input>
                        </el-form-item>
                        <el-form-item class="input-field col s12" prop="password">
                            <el-input type="textarea" placeholder="Message" v-model="form.message" auto-complete="off"></el-input>
                        </el-form-item>
                        <div class="contact-footer">
                            <el-button :plain="true" type="success"  @click="sendMessage">SEND</el-button>
                        </div>
                    </div>
                </el-form>
            </div>
            <div class="footer-links">
                <div class="footer-col">
                    <p class="footer-header">TRANSPARENT</p>
                    <ul>
                        <li><router-link to="\">HOME</router-link></li>
                        <li><router-link to="\register">SIGN UP</router-link></li>
                        <!--<li>ABOUT US</li>-->
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-lower">
            <!--Copyright,sitemap,privacy policy,disclimer,terms of use,social media-->
            <div class="footer-links right-links">
                <ul>
                    <li><router-link to="\privacy-policy">Privacy Policy</router-link></li>
                    <li><router-link to="\sitemap">Sitemap</router-link></li>
                    <li><router-link to="\termsofuse">Terms Of Use</router-link></li>
                </ul>
            </div>
            <div class="copyright">
                <p style="margin: auto;"> &copy; 2017 All rights reserved</p>
                <p style="
                margin: auto;
                font-family: 'Libre Barcode 39 Text',sans-serif;
                font-size: 30px;
                padding: 0 20px">FLY CODE </p>
            </div>
        </div>

    </footer>
</template>
<script>
    export default {
        data(){
            return{
                form:{
                    email:'',
                    message: ''
                },
                rules:{

                }
            }
        },
        methods:{
            sendMessage(){
                console.log('coming soon');
            }
        }
    }
</script>
<style lang="scss">
    //noinspection CssUnknownTarget
    @import "~sass/variables";
    @import "~bourbon/app/assets/stylesheets/bourbon";


    .footer-links{
        margin: 0;
        height: 100%;
        color: white;
        ul{
            margin: 0;
            list-style-type: none;
            a{
                text-decoration: none;
                color: #636b6f;
                &:hover{
                    color: lighten(#636b6f,10%);
                }
            }
        }
    }
    .fly-footer{
        .contact-form{
            padding: 20px;
            input,textarea{
                background: #091d44;
                border: none;
                box-shadow: 0 1px 0 0 rgba(255, 255, 255, 0.1);
            }
            button{
                background-color: #184392;
                border: none;
                color: white;
            }
            .contact-footer{
                text-align: right;
            }
        }
        .footer-upper {
            @include position(relative, null 0 0 0);
            @include size(100% 250px);
            display: flex;

            .footer-contact {
                @include position(relative);
                @include size(500px 100%);
                background-color: #000073;
                z-index: 1;
                &:before {
                    @include position(absolute, 0);
                    @include size(100%);
                    content: '';
                    z-index: -1;
                    background-color: inherit;
                    -webkit-box-shadow: inset -5px 0px 5px 0px rgba(0,0,0,0.38);
                    box-shadow: inset -5px 0px 5px 0px rgba(0,0,0,0.38);
                    transform-origin: bottom right;
                    transform: sKewX(-20deg);
                }
            }
            .footer-links {
                @include position(relative);
                @include size(100%);
                background-color: $brand-primary;
                display: grid;
                grid-template-columns: 1fr 1fr 1fr;
                padding-left: 100px;
            }
        }
        .footer-lower{
            position: relative;
            bottom: 0;
            height: 40px;
            background-color: darken($brand-primary,5%);
            .right-links{
                float: left;
                display: flex;
                ul{
                    margin: auto;
                    li{
                        display: inline;
                        margin: 0 15px;
                    }
                }
            }
            .copyright{
                float: right;
                display: flex;
                height: 100%;
            }
        }

    }
</style>