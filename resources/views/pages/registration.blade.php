    @include('partials.header_guest')

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form action="">
                <div class="card card-danger card-outline">
                    <div class="card-header">
                        <h5 class="card-title m-0">Registration</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Firstname</label>
                            <input type="email" class="form-control" placeholder="Firstname"  data-key="FirstName" data="req">
                        </div>
                        <div class="form-group">
                            <label for="">Middlename</label>
                            <input type="email" class="form-control" placeholder="Middlename"  data-key="MiddleName" data="req">
                        </div>
                        <div class="form-group">
                            <label for="">Lastname</label>
                            <input type="email" class="form-control" placeholder="Lastname"  data-key="LastName" data="req">
                        </div>
                        <div class="form-group">
                            <label for="">Birthdate</label>
                            <input type="date" class="form-control" placeholder=""  data-key="Birthdate" data="req">
                        </div>
                        
                        <div class="form-group">
                            <label for="">Contact</label>
                            <input type="text" class="form-control" placeholder="Contact Number"  data-key="ContactNo" data="req">
                        </div>
                        <div class="form-group">
                            <label for="">Email address</label>
                            <input type="email" class="form-control" placeholder="Enter email"  data-key="Email" data="req">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" placeholder="Password"  data-key="Password" data="req">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Confirm Password</label>
                            <input type="password" class="form-control" placeholder="Confirm Password"  data-key="ConfirmPassword" data="req">
                        </div>
                        <div class="row">
                            <div class="col-8">
                              <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                <label for="agreeTerms">
                                 I agree to the <a href="#" data-toggle="modal" data-target="#modal-tnc">Terms and Condition</a>
                                </label>
                              </div>
                            </div>
                            
                            <!-- /.col -->
                          </div>
                    </div>
                    
                    <div class="card-footer clearfix">
                        <div class="d-flex justify-content-between">

                            <button class="btn btn-outline-success" data-trigger="submit">
                                <i class="fas fa-user-plus"></i> Sign-Up
                            </button>

                            <a class="btn btn-outline-danger" href="/">
                                <i class="fa fa-undo"></i> Cancel
                            </a>

                        </div>
                    </div>
                </div>
            </form>
        </div>
        
    </div>

    <div class="modal fade" id="modal-tnc" aria-modal="true" role="dialog">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">
						Terms And Conditions
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					  </button>
				</div>
				<div class="modal-body">
                    <p>Creating terms and conditions for data privacy is essential for ensuring transparency and legal compliance when handling user data. Below is a general template for data privacy terms and conditions. Note that this template should be customized to fit your specific business practices, services, and local legal requirements (such as GDPR in Europe, CCPA in California, etc.).</p>
                    <p>**Terms and Conditions for Data Privacy**</p>
                    <p>**Last Updated: January 31, 2025**</p>
                    <p>**1. Introduction**</p>
                    <p>Welcome to ETEEAP-AU ("we," "us," or "our"). This document outlines our policies regarding the collection, use, and disclosure of your personal information when you use our services and informs you about your privacy rights and how the law protects you.</p>
                    <p>**2. Information We Collect**</p>
                    <p>We may collect personal information about you in a variety of ways, including:</p>
                    <p>- **Personal Data:** Information you provide directly to us, such as your name, email address, phone number, and payment information.</p>
                    <p>- **Usage Data:** Information collected automatically when you use our services, including your IP address, browser type, pages visited, and time spent on those pages.</p>
                    <p>- **Cookies and Tracking Technologies:** We may use cookies, web beacons, and similar technologies to collect information about your interactions with our website and services.</p>
                    <p>**3. How We Use Your Information**</p>
                    <p>We use the information we collect for various purposes, including:</p>
                    <p>- To provide and maintain our services</p>
                    <p>- To notify you about changes to our services</p>
                    <p>- To allow you to participate in interactive features of our service</p>
                    <p>- To provide customer support</p>
                    <p>- To gather analysis or valuable information so that we can improve our services</p>
                    <p>- To monitor the usage of our services</p>
                    <p>- To detect, prevent, and address technical issues</p>
                    <p>- To fulfill any other purpose for which you provide it</p>
                    <p>- To provide you with news, special offers, and general information about other services that we offer</p>
                    <p>**4. Sharing Your Information**</p>
                    <p>We do not sell or rent your personal information to third parties. We may share your information in the following situations:</p>
                    <p>- With service providers to facilitate our services</p>
                    <p>- For compliance with legal obligations</p>
                    <p>- To protect and defend our rights</p>
                    <p>- In connection with a merger or acquisition</p>
                    <p>**5. Data Security**</p>
                    <p>We prioritize the security of your personal information and use reasonable measures to protect it from unauthorized access, use, alteration, or destruction. However, please be aware that no method of transmission over the internet or method of electronic storage is 100% secure.</p>
                    <p>**6. Your Rights**</p>
                    <p>Depending on your location, you may have the following rights regarding your personal data:</p>
                    <p>- The right to access — You have the right to request copies of your personal data.</p>
                    <p>- The right to rectification — You have the right to request that we correct any information you believe is inaccurate or incomplete.</p>
                    <p>- The right to erasure — You have the right to request that we erase your personal data, under certain conditions.</p>
                    <p>- The right to restrict processing — You have the right to request that we restrict the processing of your personal data, under certain conditions.</p>
                    <p>- The right to data portability — You have the right to request that we transfer the data that we have collected to another organization, or directly to you, under certain conditions.</p>
                    <p>**7. Changes to This Privacy Policy**</p>
                    <p>We may update our data privacy terms from time to time. We will notify you of any changes by posting the new terms on this page. You are advised to review this page periodically for any changes.</p>
                    <p>**8. Contact Us**</p>
                    <p>If you have any questions about these data privacy terms, please contact us:</p>
                    <p>[Your Contact Information]  </p>
                    <p>[Your Company Address]  </p>
                    <p>[Your Email Address]  </p>
                    <p>[Your Phone Number]</p>
                    <p>---</p>
                    <p>### Important Notes:</p>
                    <p>1. **Legal Compliance**: Always ensure that your data privacy policy complies with the laws applicable to your business and the locations where you operate. Consider consulting with a legal expert.</p>
                    <p>2. **Customization**: Personalize the content according to your business operations and the specific types of data you collect.</p>
                    <p>3. **User Consent**: Depending on the jurisdiction, you may need to obtain explicit consent from users for data collection and processing.</p>
                    <p>4. **Clarity**: Use clear and accessible language to ensure that your users understand the terms.</p>
                </div>
            </div>
        </div>
    </div>
    @include('partials.footer')
    <script src="{{asset('scripts/modules/registration.js')}}"></script>