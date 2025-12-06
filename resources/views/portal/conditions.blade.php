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
    <br><br>
    <br>


    <div class="terms-container"
        style="margin: 0 20px; padding: 30px; background: #fff; border-radius: 12px; box-shadow: 0 2px 15px rgba(0,0,0,0.08);">
        <h1 style="color: #1a365d; font-size: 2rem; margin-bottom: 10px; text-align: center;">TEAMSAPP TERMS OF USE</h1>
        <p style="text-align: center; color: #666; margin-bottom: 30px;"><strong>Last updated: September 10, 2025</strong>
        </p>

        <p style="line-height: 1.8; color: #333; margin-bottom: 20px;">
            Welcome to <strong>TeamsApp</strong>, a mobile application provided by Flyeasy Apps ("we," "us," or "our").
            These Terms of Use ("Terms") govern your access to and use of the TeamsApp mobile application, website
            (TeamsApp.io), and related services (collectively, the "Services"). By accessing or using our Services, you
            agree to be bound by these Terms. If you do not agree with these Terms, please do not use our Services.
        </p>

        <div
            style="background: #fef3c7; border-left: 4px solid #f59e0b; padding: 15px; margin: 20px 0; border-radius: 4px;">
            <strong>PLEASE READ THESE TERMS CAREFULLY, AS THEY CONTAIN IMPORTANT INFORMATION ABOUT YOUR RIGHTS, OBLIGATIONS,
                AND LEGAL REMEDIES, INCLUDING LIMITATIONS OF LIABILITY, A CLASS ACTION WAIVER, AND MANDATORY
                ARBITRATION.</strong>
        </div>

        <h2
            style="color: #1a365d; font-size: 1.5rem; margin: 30px 0 15px; padding-bottom: 10px; border-bottom: 2px solid #e2e8f0;">
            TABLE OF CONTENTS</h2>
        <ol style="line-height: 2; color: #4a5568; padding-left: 20px;">
            <li>Acceptance of Terms</li>
            <li>Eligibility</li>
            <li>Account Creation and Responsibilities</li>
            <li>Use of the Services</li>
            <li>User Content</li>
            <li>Intellectual Property</li>
            <li>Prohibited Conduct</li>
            <li>Fees and Payment</li>
            <li>Termination</li>
            <li>Privacy</li>
            <li>Third-Party Services</li>
            <li>Disclaimers and Limitation of Liability</li>
            <li>Indemnification</li>
            <li>Governing Law and Dispute Resolution</li>
            <li>Modifications to the Terms</li>
            <li>Contact Information</li>
        </ol>

        <h2 style="color: #1a365d; font-size: 1.3rem; margin: 30px 0 15px;">1. ACCEPTANCE OF TERMS</h2>
        <p style="line-height: 1.8; color: #333; margin-bottom: 15px;">
            By downloading, installing, or using TeamsApp, or by accessing our website or Services, you agree to these Terms
            and our Privacy Notice (available at <a href="https://TeamsApp.io/privacy"
                style="color: #3182ce;">TeamsApp.io/privacy</a>). These Terms form a legally binding agreement between you
            and Flyeasy Apps. If you are using the Services on behalf of a business or organization, you represent that you
            have the authority to bind that entity to these Terms.
        </p>

        <h2 style="color: #1a365d; font-size: 1.3rem; margin: 30px 0 15px;">2. ELIGIBILITY</h2>
        <p style="line-height: 1.8; color: #333; margin-bottom: 10px;">To use the Services, you must:</p>
        <ul style="line-height: 1.8; color: #333; padding-left: 25px; margin-bottom: 15px;">
            <li>Be at least 13 years of age. If you are under 13, you may not use the Services. For users aged 13-16 (or the
                applicable age of consent in your jurisdiction), parental consent may be required in accordance with our
                Privacy Notice and applicable laws, such as the Children's Online Privacy Protection Act (COPPA).</li>
            <li>Not be barred from using the Services under applicable law.</li>
            <li>Comply with these Terms and all applicable local, state, national, and international laws and regulations.
            </li>
        </ul>

        <h2 style="color: #1a365d; font-size: 1.3rem; margin: 30px 0 15px;">3. ACCOUNT CREATION AND RESPONSIBILITIES</h2>
        <p style="line-height: 1.8; color: #333; margin-bottom: 10px;">To access certain features of the Services, you must
            create an account. You agree to:</p>
        <ul style="line-height: 1.8; color: #333; padding-left: 25px; margin-bottom: 15px;">
            <li>Provide accurate, current, and complete information during registration.</li>
            <li>Maintain the security of your account by keeping your password confidential and not sharing it with others.
            </li>
            <li>Notify us immediately of any unauthorized access or use of your account at privacy@TeamsApp.io.</li>
            <li>Be responsible for all activities that occur under your account.</li>
        </ul>
        <p style="line-height: 1.8; color: #333; margin-bottom: 15px;">
            We reserve the right to suspend or terminate your account if we suspect fraudulent, unauthorized, or illegal
            activity, or if you violate these Terms.
        </p>

        <h2 style="color: #1a365d; font-size: 1.3rem; margin: 30px 0 15px;">4. USE OF THE SERVICES</h2>
        <p style="line-height: 1.8; color: #333; margin-bottom: 10px;">
            TeamsApp provides a platform for managing teams, tasks, and projects, as well as communication features such as
            chat, voice, and video calls. You are granted a non-exclusive, non-transferable, revocable license to use the
            Services for personal or business purposes in accordance with these Terms. You may:
        </p>
        <ul style="line-height: 1.8; color: #333; padding-left: 25px; margin-bottom: 15px;">
            <li>Create and manage teams, share files, and communicate with team members.</li>
            <li>Use the Services for lawful purposes only.</li>
        </ul>
        <p style="line-height: 1.8; color: #333; margin-bottom: 10px;">You may not:</p>
        <ul style="line-height: 1.8; color: #333; padding-left: 25px; margin-bottom: 15px;">
            <li>Modify, reverse-engineer, decompile, or attempt to derive the source code of the Services.</li>
            <li>Use the Services to engage in illegal activities or to infringe upon the rights of others.</li>
            <li>Attempt to gain unauthorized access to the Services or related systems.</li>
        </ul>

        <h2 style="color: #1a365d; font-size: 1.3rem; margin: 30px 0 15px;">5. USER CONTENT</h2>
        <p style="line-height: 1.8; color: #333; margin-bottom: 10px;">
            You may upload, share, or transmit content such as messages, files, or media ("User Content") through the
            Services. You represent and warrant that:
        </p>
        <ul style="line-height: 1.8; color: #333; padding-left: 25px; margin-bottom: 15px;">
            <li>You own or have the necessary rights to share User Content.</li>
            <li>User Content does not violate the intellectual property, privacy, or other rights of third parties.</li>
            <li>User Content complies with applicable laws and these Terms.</li>
        </ul>
        <p style="line-height: 1.8; color: #333; margin-bottom: 15px;">
            By submitting User Content, you grant us a worldwide, non-exclusive, royalty-free, transferable license to use,
            store, display, and process such content solely to provide and improve the Services. We may remove or restrict
            access to User Content that violates these Terms or applicable laws.
        </p>

        <h2 style="color: #1a365d; font-size: 1.3rem; margin: 30px 0 15px;">6. INTELLECTUAL PROPERTY</h2>
        <p style="line-height: 1.8; color: #333; margin-bottom: 15px;">
            The Services, including all software, designs, text, images, and other content (excluding User Content), are
            owned by Flyeasy Apps or its licensors and are protected by copyright, trademark, and other intellectual
            property laws. You may not copy, distribute, modify, or create derivative works of the Services without our
            prior written consent.
        </p>
        <p style="line-height: 1.8; color: #333; margin-bottom: 15px;">
            The "TeamsApp" name and logo are trademarks of Flyeasy Apps. You may not use these trademarks without our
            express permission.
        </p>

        <h2 style="color: #1a365d; font-size: 1.3rem; margin: 30px 0 15px;">7. PROHIBITED CONDUCT</h2>
        <p style="line-height: 1.8; color: #333; margin-bottom: 10px;">You agree not to engage in any of the following
            activities:</p>
        <ul style="line-height: 1.8; color: #333; padding-left: 25px; margin-bottom: 15px;">
            <li>Using the Services for unlawful, harassing, defamatory, abusive, or fraudulent purposes.</li>
            <li>Uploading or sharing content that is obscene, offensive, or harmful.</li>
            <li>Impersonating another person or entity or misrepresenting your affiliation with any person or entity.</li>
            <li>Interfering with or disrupting the Services, including by introducing viruses or malicious code.</li>
            <li>Attempting to bypass security measures or access restricted areas of the Services.</li>
            <li>Using automated systems (e.g., bots, scripts) to access or scrape the Services without permission.</li>
            <li>Engaging in any activity that violates applicable laws or these Terms.</li>
        </ul>
        <p style="line-height: 1.8; color: #333; margin-bottom: 15px;">
            We reserve the right to investigate and take appropriate action, including termination of your account, for any
            violation of these Terms.
        </p>

        <h2 style="color: #1a365d; font-size: 1.3rem; margin: 30px 0 15px;">8. FEES AND PAYMENT</h2>
        <p style="line-height: 1.8; color: #333; margin-bottom: 10px;">
            Certain features of the Services may require payment, such as subscription plans or premium features. By
            purchasing a subscription, you agree to:
        </p>
        <ul style="line-height: 1.8; color: #333; padding-left: 25px; margin-bottom: 15px;">
            <li>Pay all applicable fees as described during the purchase process.</li>
            <li>Provide accurate billing and payment information.</li>
            <li>Authorize us or our third-party payment processors (e.g., Stripe, PayPal) to charge your chosen payment
                method.</li>
        </ul>
        <p style="line-height: 1.8; color: #333; margin-bottom: 15px;">
            All fees are non-refundable unless otherwise required by law. We may offer a free trial, during which you may
            cancel without charge. After the trial, your subscription will automatically renew unless canceled before the
            renewal date. Details about pricing and subscriptions are available at <a href="https://TeamsApp.io/pricing"
                style="color: #3182ce;">TeamsApp.io/pricing</a>.
        </p>

        <h2 style="color: #1a365d; font-size: 1.3rem; margin: 30px 0 15px;">9. TERMINATION</h2>
        <p style="line-height: 1.8; color: #333; margin-bottom: 10px;">
            We may suspend or terminate your access to the Services at our discretion, with or without notice, for reasons
            including but not limited to:
        </p>
        <ul style="line-height: 1.8; color: #333; padding-left: 25px; margin-bottom: 15px;">
            <li>Violation of these Terms.</li>
            <li>Suspected fraudulent or illegal activity.</li>
            <li>Failure to pay applicable fees.</li>
            <li>Inactivity for an extended period (e.g., 12 months).</li>
        </ul>
        <p style="line-height: 1.8; color: #333; margin-bottom: 15px;">
            You may terminate your account at any time by accessing your account settings or contacting us at
            privacy@TeamsApp.io. Upon termination, your license to use the Services ends, and we may delete your account
            data, subject to our Privacy Notice and applicable laws.
        </p>

        <h2 style="color: #1a365d; font-size: 1.3rem; margin: 30px 0 15px;">10. PRIVACY</h2>
        <p style="line-height: 1.8; color: #333; margin-bottom: 15px;">
            Your privacy is important to us. Our Privacy Notice (<a href="https://TeamsApp.io/privacy"
                style="color: #3182ce;">TeamsApp.io/privacy</a>) explains how we collect, use, store, and share your
            personal information. By using the Services, you consent to our data practices as described in the Privacy
            Notice.
        </p>

        <h2 style="color: #1a365d; font-size: 1.3rem; margin: 30px 0 15px;">11. THIRD-PARTY SERVICES</h2>
        <p style="line-height: 1.8; color: #333; margin-bottom: 15px;">
            The Services may integrate with or link to third-party services, such as payment processors or communication
            tools. Your use of these third-party services is subject to their respective terms and privacy policies. We are
            not responsible for the practices or content of third-party services.
        </p>

        <h2 style="color: #1a365d; font-size: 1.3rem; margin: 30px 0 15px;">12. DISCLAIMERS AND LIMITATION OF LIABILITY</h2>
        <p style="line-height: 1.8; color: #333; margin-bottom: 15px;">
            <strong>Disclaimers:</strong> The Services are provided on an "as-is" and "as-available" basis. We do not
            warrant that the Services will be uninterrupted, error-free, or free of viruses or other harmful components. To
            the fullest extent permitted by law, we disclaim all warranties, express or implied, including warranties of
            merchantability, fitness for a particular purpose, and non-infringement.
        </p>
        <p style="line-height: 1.8; color: #333; margin-bottom: 15px;">
            <strong>Limitation of Liability:</strong> To the maximum extent permitted by law, Flyeasy Apps, its affiliates,
            and their respective officers, directors, employees, or agents will not be liable for any indirect, incidental,
            special, consequential, or punitive damages, including loss of profits, data, or goodwill, arising out of or
            related to your use of the Services. Our total liability for any claim arising from these Terms or the Services
            will not exceed the amount you paid us in the preceding twelve (12) months or $100, whichever is greater.
        </p>
        <p style="line-height: 1.8; color: #666; font-style: italic; margin-bottom: 15px;">
            Some jurisdictions do not allow the exclusion of certain warranties or limitations of liability, so the above
            limitations may not apply to you.
        </p>

        <h2 style="color: #1a365d; font-size: 1.3rem; margin: 30px 0 15px;">13. INDEMNIFICATION</h2>
        <p style="line-height: 1.8; color: #333; margin-bottom: 10px;">
            You agree to indemnify, defend, and hold harmless Flyeasy Apps, its affiliates, and their respective officers,
            directors, employees, and agents from any claims, liabilities, damages, or expenses (including reasonable
            attorneys' fees) arising from:
        </p>
        <ul style="line-height: 1.8; color: #333; padding-left: 25px; margin-bottom: 15px;">
            <li>Your use of the Services.</li>
            <li>Your violation of these Terms.</li>
            <li>Your User Content.</li>
            <li>Your violation of any third-party rights, including intellectual property or privacy rights.</li>
        </ul>

        <h2 style="color: #1a365d; font-size: 1.3rem; margin: 30px 0 15px;">14. GOVERNING LAW AND DISPUTE RESOLUTION</h2>
        <p style="line-height: 1.8; color: #333; margin-bottom: 15px;">
            <strong>Governing Law:</strong> These Terms are governed by the laws of the State of Delaware, USA, without
            regard to its conflict of law principles.
        </p>
        <p style="line-height: 1.8; color: #333; margin-bottom: 15px;">
            <strong>Arbitration:</strong> Any dispute arising out of or relating to these Terms or the Services will be
            resolved through binding arbitration in accordance with the American Arbitration Association (AAA) rules.
            Arbitration will take place in Delaware, USA, unless otherwise agreed. You waive any right to participate in a
            class action lawsuit or class-wide arbitration. The arbitrator's decision will be final and binding, except as
            provided by law.
        </p>
        <p style="line-height: 1.8; color: #333; margin-bottom: 15px;">
            <strong>Exceptions:</strong> Disputes involving intellectual property or claims seeking injunctive relief may be
            resolved in a court of competent jurisdiction in Delaware, USA.
        </p>
        <p style="line-height: 1.8; color: #333; margin-bottom: 15px;">
            <strong>Time Limit:</strong> Any claim must be brought within one (1) year after the cause of action arises, or
            it will be permanently barred.
        </p>

        <h2 style="color: #1a365d; font-size: 1.3rem; margin: 30px 0 15px;">15. MODIFICATIONS TO THE TERMS</h2>
        <p style="line-height: 1.8; color: #333; margin-bottom: 15px;">
            We may update these Terms from time to time to reflect changes in our Services or applicable laws. The updated
            Terms will be posted on our website at <a href="https://TeamsApp.io/terms"
                style="color: #3182ce;">TeamsApp.io/terms</a> with an updated "Last updated" date. If we make material
            changes, we may notify you by email or through the Services. Your continued use of the Services after the
            updated Terms are posted constitutes your acceptance of the revised Terms.
        </p>

        <h2 style="color: #1a365d; font-size: 1.3rem; margin: 30px 0 15px;">16. CONTACT INFORMATION</h2>
        <p style="line-height: 1.8; color: #333; margin-bottom: 15px;">
            If you have questions, concerns, or feedback about these Terms, please contact us at:
        </p>
        <div style="background: #f7fafc; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
            <p style="margin: 0; line-height: 1.8; color: #333;">
                <strong>TeamsApp</strong><br>
                Flyeasy Apps<br>
                Email: <a href="mailto:support@TeamsApp.io" style="color: #3182ce;">support@TeamsApp.io</a>
            </p>
        </div>
        <p style="line-height: 1.8; color: #333; margin-bottom: 15px;">
            For privacy-related inquiries, please contact <a href="mailto:privacy@TeamsApp.io"
                style="color: #3182ce;">privacy@TeamsApp.io</a>.
        </p>

        <hr style="border: none; border-top: 1px solid #e2e8f0; margin: 30px 0;">

        <p style="line-height: 1.8; color: #333; text-align: center; font-style: italic;">
            By using TeamsApp, you acknowledge that you have read, understood, and agree to be bound by these Terms. Thank
            you for choosing TeamsApp to power your team's collaboration!
        </p>
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