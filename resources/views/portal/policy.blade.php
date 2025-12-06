@extends('portal.layout.app')

@section('content')
    <div class="section1">
        <nav class="navbar justify-content-around">
            <div class="header">
                <img src="{{ asset('portal/images/final logo 1.png') }}" alt="" />
                <div>{{ __('portal.FlyEasy') }}</div>
            </div>
        </nav>
        <div id='Home' class="container mt-4">
            <div class="row">
                <div class="col-lg-6">
                    <p class="p-s">
                        <img style="margin-top: -90px;margin-left: -1px; width: 140px; height: 90px;"
                            src="{{ asset('portal/images/Frame 237719.png') }}" alt="" /><br><br>
                        Where every message sparks a conversation<br>
                        and every conversation sparks a connection.
                    </p>
                    <h1>
                        vibrant communication<br> Smarter teamwork
                    </h1><br>
                    <button class="btn btn-info app">{{ __('portal.App Store') }}</button>
                    <button class="btn btn-success ios">{{ __('portal.Android') }}</button>
                </div>
                <div class="col-lg-6">
                    <img src="{{ asset('portal/images/Scene.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    <br><br><br>

    <div class="privacy-container"
        style="margin: 0 20px; padding: 30px; background: #fff; border-radius: 12px; box-shadow: 0 2px 15px rgba(0,0,0,0.08);">
        <h1 style="color: #1a365d; font-size: 2rem; margin-bottom: 10px; text-align: center;">PRIVACY NOTICE</h1>
        <p style="text-align: center; color: #666; margin-bottom: 30px;"><strong>Last updated: September 10, 2025</strong>
        </p>

        <p style="line-height: 1.8; color: #333; margin-bottom: 20px;">
            This privacy notice for <strong>TeamsApp</strong> ("we," "us," or "our") describes how and why we might collect,
            store, use, and/or share ("process") your information when you use our services ("Services"), such as when you:
        </p>

        <ul style="line-height: 1.8; color: #333; padding-left: 25px; margin-bottom: 20px;">
            <li>Visit our website at TeamsApp.io, or any website of ours that links to this privacy notice;</li>
            <li>Download and use our mobile application (TeamsApp), or any other application of ours that links to this
                privacy notice; or</li>
            <li>Engage with us in other related ways, including any sales, marketing, or events.</li>
        </ul>

        <div
            style="background: #e0f2fe; border-left: 4px solid #0284c7; padding: 15px; margin: 20px 0; border-radius: 4px;">
            <strong>Questions or concerns?</strong> Reading this privacy notice will help you understand your privacy rights
            and choices. If you do not agree with our policies and practices, please do not use our Services.
        </div>

        <h2
            style="color: #1a365d; font-size: 1.5rem; margin: 30px 0 15px; padding-bottom: 10px; border-bottom: 2px solid #e2e8f0;">
            SUMMARY OF KEY POINTS</h2>
        <p style="line-height: 1.8; color: #333; margin-bottom: 15px;">This summary provides key points from our privacy
            notice:</p>
        <ul style="line-height: 1.8; color: #333; padding-left: 25px; margin-bottom: 20px;">
            <li><strong>What personal information do we process?</strong> When you visit, use, or navigate our Services, we
                may process personal information depending on how you interact with us and the Services, the choices you
                make, and the products and features you use.</li>
            <li><strong>How do we process your information?</strong> We process your information to provide, improve, and
                administer our Services, communicate with you, for security and fraud prevention, and to comply with law.
            </li>
            <li><strong>In what situations and with which parties do we share personal information?</strong> We may share
                information in specific situations and with specific third parties.</li>
            <li><strong>What are your rights?</strong> Depending on where you are located geographically, the applicable
                privacy law may mean you have certain rights regarding your personal information.</li>
            <li><strong>How do you exercise your rights?</strong> The easiest way to exercise your rights is by submitting a
                data subject access request, or by contacting us.</li>
        </ul>

        <h2
            style="color: #1a365d; font-size: 1.5rem; margin: 30px 0 15px; padding-bottom: 10px; border-bottom: 2px solid #e2e8f0;">
            TABLE OF CONTENTS</h2>
        <ol style="line-height: 2; color: #4a5568; padding-left: 20px;">
            <li>What Information Do We Collect?</li>
            <li>How Do We Process Your Information?</li>
            <li>What Legal Bases Do We Rely On To Process Your Personal Information?</li>
            <li>When And With Whom Do We Share Your Personal Information?</li>
            <li>Do We Use Cookies And Other Tracking Technologies?</li>
            <li>Is Your Information Transferred Internationally?</li>
            <li>How Long Do We Keep Your Information?</li>
            <li>Do We Collect Information From Minors?</li>
            <li>What Are Your Privacy Rights?</li>
            <li>Controls For Do-Not-Track Features</li>
            <li>Do United States Residents Have Specific Privacy Rights?</li>
            <li>Do We Make Updates To This Notice?</li>
            <li>How Can You Contact Us About This Notice?</li>
            <li>How Can You Review, Update, Or Delete The Data We Collect From You?</li>
        </ol>

        <h2 style="color: #1a365d; font-size: 1.3rem; margin: 30px 0 15px;">1. WHAT INFORMATION DO WE COLLECT?</h2>
        <h3 style="color: #2d3748; font-size: 1.1rem; margin: 20px 0 10px;">Personal information you disclose to us</h3>
        <p style="line-height: 1.8; color: #666; font-style: italic; margin-bottom: 15px;"><strong>In Short:</strong> We
            collect personal information that you provide to us.</p>
        <p style="line-height: 1.8; color: #333; margin-bottom: 15px;">We collect personal information that you voluntarily
            provide to us when you register on the Services, when you participate in activities on the Services (such as by
            posting messages, uploading files, or making voice/video calls), or otherwise when you contact us.</p>
        <p style="line-height: 1.8; color: #333; margin-bottom: 10px;"><strong>Personal Information Provided by
                You:</strong></p>
        <ul style="line-height: 1.8; color: #333; padding-left: 25px; margin-bottom: 15px;">
            <li>Phone numbers</li>
            <li>Email addresses</li>
            <li>Usernames</li>
            <li>Passwords</li>
            <li>Billing addresses</li>
            <li>Debit/credit card numbers</li>
            <li>Bank account information</li>
        </ul>
        <p style="line-height: 1.8; color: #333; margin-bottom: 15px;"><strong>Sensitive Information:</strong> We do not
            process sensitive information beyond what is necessary for the core functionality of the Services, such as voice
            and video calls, and only with explicit consent where required by law.</p>
        <p style="line-height: 1.8; color: #333; margin-bottom: 15px;"><strong>Payment Data:</strong> We may collect data
            necessary to process your payment. All payment data is stored by our third-party payment processors, such as <a
                href="https://stripe.com/privacy" style="color: #3182ce;">Stripe</a> or <a
                href="https://www.paypal.com/privacy" style="color: #3182ce;">PayPal</a>.</p>

        <h2 style="color: #1a365d; font-size: 1.3rem; margin: 30px 0 15px;">2. HOW DO WE PROCESS YOUR INFORMATION?</h2>
        <p style="line-height: 1.8; color: #666; font-style: italic; margin-bottom: 15px;"><strong>In Short:</strong> We
            process your information to provide, improve, and administer our Services, communicate with you, for security
            and fraud prevention, and to comply with law.</p>
        <ul style="line-height: 1.8; color: #333; padding-left: 25px; margin-bottom: 15px;">
            <li>To facilitate account creation and authentication</li>
            <li>To enable communication and collaboration</li>
            <li>To provide, improve, and administer our Services</li>
            <li>To communicate with you</li>
            <li>To save or protect an individual's vital interest</li>
            <li>To comply with legal obligations</li>
            <li>For security and fraud prevention</li>
            <li>For internal analytics and reporting</li>
        </ul>

        <h2 style="color: #1a365d; font-size: 1.3rem; margin: 30px 0 15px;">3. WHAT LEGAL BASES DO WE RELY ON TO PROCESS
            YOUR PERSONAL INFORMATION?</h2>
        <p style="line-height: 1.8; color: #666; font-style: italic; margin-bottom: 15px;"><strong>In Short:</strong> We
            only process your personal information when we believe it is necessary and we have a valid legal reason to do so
            under applicable law.</p>
        <p style="line-height: 1.8; color: #333; margin-bottom: 15px;"><strong>If you are located in the EU or UK:</strong>
        </p>
        <ul style="line-height: 1.8; color: #333; padding-left: 25px; margin-bottom: 15px;">
            <li><strong>Consent:</strong> We may process your information if you have given us permission.</li>
            <li><strong>Performance of a contract:</strong> We may process your information to fulfill our contractual
                obligations.</li>
            <li><strong>Legal Obligations:</strong> We may process your information for compliance with our legal
                obligations.</li>
            <li><strong>Vital Interests:</strong> We may process your information to protect vital interests.</li>
            <li><strong>Legitimate interests:</strong> We may process your information for our legitimate business
                interests.</li>
        </ul>

        <h2 style="color: #1a365d; font-size: 1.3rem; margin: 30px 0 15px;">4. WHEN AND WITH WHOM DO WE SHARE YOUR PERSONAL
            INFORMATION?</h2>
        <p style="line-height: 1.8; color: #666; font-style: italic; margin-bottom: 15px;"><strong>In Short:</strong> We may
            share information in specific situations and with specific third parties.</p>
        <ul style="line-height: 1.8; color: #333; padding-left: 25px; margin-bottom: 15px;">
            <li><strong>Vendors, Service Providers:</strong> Third parties that help provide our Services</li>
            <li><strong>Business Transfers:</strong> During mergers, sales, or acquisitions</li>
            <li><strong>Affiliates:</strong> Our parent company and subsidiaries</li>
            <li><strong>Business Partners:</strong> To offer certain products or promotions</li>
            <li><strong>Law Enforcement:</strong> When required by law</li>
        </ul>
        <p style="line-height: 1.8; color: #333; margin-bottom: 15px;">We do not share or sell your information to third
            parties for marketing purposes without your consent.</p>

        <h2 style="color: #1a365d; font-size: 1.3rem; margin: 30px 0 15px;">5. DO WE USE COOKIES AND OTHER TRACKING
            TECHNOLOGIES?</h2>
        <p style="line-height: 1.8; color: #666; font-style: italic; margin-bottom: 15px;"><strong>In Short:</strong> We may
            use cookies and other tracking technologies to collect and store your information.</p>
        <p style="line-height: 1.8; color: #333; margin-bottom: 15px;">We may use cookies and similar tracking technologies.
            Specific information is set out in our Cookie Notice at <a href="https://TeamsApp.io/cookies"
                style="color: #3182ce;">TeamsApp.io/cookies</a>.</p>

        <h2 style="color: #1a365d; font-size: 1.3rem; margin: 30px 0 15px;">6. IS YOUR INFORMATION TRANSFERRED
            INTERNATIONALLY?</h2>
        <p style="line-height: 1.8; color: #666; font-style: italic; margin-bottom: 15px;"><strong>In Short:</strong> We may
            transfer, store, and process your information in countries other than your own, including the United States.</p>
        <p style="line-height: 1.8; color: #333; margin-bottom: 15px;">Our servers are located in the United States. We take
            steps to ensure that your information is protected under applicable laws, including through adequacy decisions,
            standard contractual clauses, or other safeguards.</p>

        <h2 style="color: #1a365d; font-size: 1.3rem; margin: 30px 0 15px;">7. HOW LONG DO WE KEEP YOUR INFORMATION?</h2>
        <p style="line-height: 1.8; color: #666; font-style: italic; margin-bottom: 15px;"><strong>In Short:</strong> We
            keep your information for as long as necessary to fulfill the purposes outlined in this privacy notice unless
            otherwise required by law.</p>

        <h2 style="color: #1a365d; font-size: 1.3rem; margin: 30px 0 15px;">8. DO WE COLLECT INFORMATION FROM MINORS?</h2>
        <p style="line-height: 1.8; color: #666; font-style: italic; margin-bottom: 15px;"><strong>In Short:</strong> We do
            not knowingly collect data from or market to children under 13 years of age without verifiable parental consent.
        </p>
        <p style="line-height: 1.8; color: #333; margin-bottom: 15px;">If you become aware of any data we may have collected
            from children under age 13, please contact us at <a href="mailto:privacy@TeamsApp.io"
                style="color: #3182ce;">privacy@TeamsApp.io</a>.</p>

        <h2 style="color: #1a365d; font-size: 1.3rem; margin: 30px 0 15px;">9. WHAT ARE YOUR PRIVACY RIGHTS?</h2>
        <p style="line-height: 1.8; color: #666; font-style: italic; margin-bottom: 15px;"><strong>In Short:</strong> In
            some regions, you have rights that allow you greater access to and control over your personal information.</p>
        <p style="line-height: 1.8; color: #333; margin-bottom: 15px;">These may include:</p>
        <ul style="line-height: 1.8; color: #333; padding-left: 25px; margin-bottom: 15px;">
            <li>Right to request access and obtain a copy of your personal information</li>
            <li>Right to request rectification or erasure</li>
            <li>Right to restrict the processing of your personal information</li>
            <li>Right to data portability</li>
            <li>Right not to be subject to automated decision-making</li>
        </ul>
        <p style="line-height: 1.8; color: #333; margin-bottom: 15px;"><strong>Withdrawing your consent:</strong> You have
            the right to withdraw your consent at any time by contacting us.</p>

        <h2 style="color: #1a365d; font-size: 1.3rem; margin: 30px 0 15px;">10. CONTROLS FOR DO-NOT-TRACK FEATURES</h2>
        <p style="line-height: 1.8; color: #333; margin-bottom: 15px;">Most web browsers include a Do-Not-Track ("DNT")
            feature. At this stage no uniform technology standard for recognizing and implementing DNT signals has been
            finalized. As such, we do not currently respond to DNT browser signals.</p>

        <h2 style="color: #1a365d; font-size: 1.3rem; margin: 30px 0 15px;">11. DO UNITED STATES RESIDENTS HAVE SPECIFIC
            PRIVACY RIGHTS?</h2>
        <p style="line-height: 1.8; color: #666; font-style: italic; margin-bottom: 15px;"><strong>In Short:</strong> If you
            are a resident of a U.S. state with comprehensive privacy laws, you are granted specific rights regarding access
            to your personal information.</p>
        <p style="line-height: 1.8; color: #333; margin-bottom: 15px;">Residents of states with privacy laws (California,
            Virginia, Colorado, Connecticut, Utah, Texas, Oregon, Montana, and others effective in 2025) have rights such as
            access, correction, deletion, and opting out of sales/sharing of personal information.</p>

        <h2 style="color: #1a365d; font-size: 1.3rem; margin: 30px 0 15px;">12. DO WE MAKE UPDATES TO THIS NOTICE?</h2>
        <p style="line-height: 1.8; color: #666; font-style: italic; margin-bottom: 15px;"><strong>In Short:</strong> Yes,
            we will update this notice as necessary to stay compliant with relevant laws.</p>
        <p style="line-height: 1.8; color: #333; margin-bottom: 15px;">We may update this privacy notice from time to time.
            The updated version will be indicated by an updated "Last updated" date.</p>

        <h2 style="color: #1a365d; font-size: 1.3rem; margin: 30px 0 15px;">13. HOW CAN YOU CONTACT US ABOUT THIS NOTICE?
        </h2>
        <div style="background: #f7fafc; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
            <p style="margin: 0; line-height: 1.8; color: #333;">
                <strong>TeamsApp Privacy Office</strong><br>
                c/o Flyeasy Apps<br>
                Email: <a href="mailto:privacy@TeamsApp.io" style="color: #3182ce;">privacy@TeamsApp.io</a>
            </p>
        </div>

        <h2 style="color: #1a365d; font-size: 1.3rem; margin: 30px 0 15px;">14. HOW CAN YOU REVIEW, UPDATE, OR DELETE THE
            DATA WE COLLECT FROM YOU?</h2>
        <p style="line-height: 1.8; color: #333; margin-bottom: 15px;">Based on the applicable laws of your country, you may
            have the right to request access to the personal information we collect from you, change that information, or
            delete it.</p>
        <p style="line-height: 1.8; color: #333; margin-bottom: 15px;">To request to review, update, or delete your personal
            information, please submit a request via our online form at <a href="https://TeamsApp.io/privacy-request"
                style="color: #3182ce;">TeamsApp.io/privacy-request</a> or email <a href="mailto:privacy@TeamsApp.io"
                style="color: #3182ce;">privacy@TeamsApp.io</a>.</p>

        <hr style="border: none; border-top: 1px solid #e2e8f0; margin: 30px 0;">
    </div>

    <div class="as"><br><br>
        <div style="margin-left: 140px">
            <svg style="color: white" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-envelope" viewBox="0 0 16 16">
                <path
                    d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z" />
            </svg><span style="color: white; margin-left: 10px">flyeasy.apps@gmail.com</span>
            <br><br>
            <svg style="color: white" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-telephone" viewBox="0 0 16 16">
                <path
                    d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z" />
            </svg><span style="color: white; margin-left: 10px">+201005777321</span><br><br><br>
        </div>
        <div class="col-lg-3">
            <p class="df">Copyright &copy; <br> FlyEasy 2024 All right reserved </p>
        </div>
        <div>
            <div class="kl">
                <div>
                    <img class="sw" src="{{ asset('portal/images/final logo 1.png') }}" alt="" />
                    <span class="x">{{ __('portal.FlyEasy') }}</span>
                </div>
                <img class="ds" src="{{ asset('portal/images/Social.png') }}" alt="" srcset="">
            </div>
        </div>
    </div>

@endsection