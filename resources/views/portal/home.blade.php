@extends('portal.layout.app')
@section('content')
{{-- <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5231374671199362"
     crossorigin="anonymous"></script>
<!-- Teams -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-5231374671199362"
     data-ad-slot="6487496030"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script> --}}
    <nav class="navbar navbar-expand-lg ">
        <div class="container">
        <a class="navbar-brand" href="#Home"> <img src="{{ asset('portal/images/final logo 1.png') }}"  alt=""/>  {{ __('portal.FlyEasy') }} </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="#Home">{{ __('portal.Home') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#About">{{ __('portal.About') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#Features">{{ __('portal.Features') }}</a>
                </li>
            </ul>
        </div>
        </div>
    </nav>
    <section id='Home'>
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <img  src="{{ asset('portal/images/1720099613914.png') }}" class="img-fluid team-link" alt=""/>
                    <p>
                        Where every message sparks a conversation<br>
                        and every conversation sparks a connection.
                    </p>
                    <h1>
                        vibrant communication<br> Smarter teamwork
                    </h1>
                    <div class="home-buttons">
                        <a target="_blank"  href="https://play.google.com/store/apps/details?id=io.flyeasy.teams">
                            <img class="img-fluid" src="{{ asset('portal/images/en_badge_web_generic.png') }}" alt="" srcset="">
                        </a>
                        <a target="_blank" href="https://apps.apple.com/eg/app/team-layered/id6503207368">
                            <img class="img-fluid" src="{{ asset('portal/images/Download_on_the_App_Store_Badge.svg.png') }}" alt="" srcset="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-7">
                    <img src="{{ asset('portal/images/Scene.png') }}" class='img-fluid' alt="">
                </div>
            </div>
        </div>
    </section>
    <section id='About'>
        <div class="container">
            <h3 class="section-head">{{ __('portal.about') }}</h3>
            <div class="row">
                <div class="col-lg-6 text-center mb-4 mb-lg-0">
                    <img class="img-fluid" src="{{ asset('portal/images/Group 1261152724.png') }}" alt="">
                </div>
                <div class="col-lg-6">
                    <h2>
                        Ignite your conversations with our revolutionary chatting app.
                    </h2>
                    <ul>
                        <li><p>Teams is a mobile app that revolutionizes how companies work. Teams is a smart and easy way to improve your business performance and communication.</p></li>
                        <li><p>Create your own teams, add friends, chat and share information, make high-quality and secured voice and video calls, and more.</p></li>
                        <li><p>Teams is a highly secure mobile application that uses the best end-to-end encryption technology to protect your data and communication.</p></li>
                        <li><p>Teams is a revolutionary mobile application that enables companies to manage and monitor their employees, work tasks, project progress, and potential problems with ease and efficiency. </p></li>
                        <li><p>Teams is user-friendly and intuitive, as it operates like the social media apps you are already familiar with. Teams is also cost-effective, as it runs entirely on your mobile device, eliminating the need for additional expensive equipment or software.</p></li>
                        <li><p>All with great privacy and end-to-end encryption. We will never share or sell your information to anyone. Teams has many affordable plans to suit your needs. Get in touch if you need a customized plan,
                            Start your free trial today.</p></li>

                    </ul>
                    <h1 >
                        Welcome to a world of vibrant communication
                    </h1>
                </div>
            </div>
        </div>
    </section>
    <section id='Features'>
        <div class="container">
            <h2 class="section-head">{{ __('portal.Our Features') }}</h2>
            <div class="row justify-content-center align-items-center">
                <div class="col-xxl-3 col-lg-4 col-sm-6">
                    <div class="features-card top">
                        <img class="img-fluid" src="{{ asset('portal/images/travel 1.png') }}" alt="">
                        <h3 >Teams and communities</h3>
                        <p>Enhance collaboration and communication in Teams. You can access various tools, information, and processes within Teams. Work smarter and more efficiently with your team </p>
                    </div>
                </div>
                <div class="col-xxl-3 col-lg-4 col-sm-6">
                    <div class="features-card bottom">
                        <img  class="img-fluid" src="{{ asset('portal/images/discount 1.png') }}" alt="">
                        <h3>Task and projects</h3>
                        <p> Teams is a collaboration platform that helps teams communicate and work together. Allows users to create and manage tasks, track progress. Users can chat with each other in private or group chats.</p>
                    </div>
                </div>
                <div class="col-xxl-3 col-lg-4 col-sm-6">
                    <div class="features-card top">
                        <img class="img-fluid" src="{{ asset('portal/images/lock (1) 1.png') }}" alt="">
                        <h3>Video / Audio conference</h3>
                        <p>Video / Audio conference Teams app offers high-quality video and audio calls with features such as noise suppression and real-time alerts These features help users communicate clearly. </p>
                    </div>
                </div>
                <div class="col-xxl-3 col-lg-4 col-sm-6">
                    <div class="features-card bottom">
                        <img  class="img-fluid" src="{{ asset('portal/images/customer-service 1.png') }}" alt="">
                        <h3>Privacy & Security</h3>
                        <p>Privacy & Security Teams app uses end-to-end encryption (E2EE) for some features, such as one-to-one calls and meetings, to protect the privacy and security of the users </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="forth-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <h1 >we bring world to your  hand</h1>
                    <p>Lorem Ipsum is simply dummy text of the printing and  typesetting industry. Lorem Ipsum has been the industry</p>
                    <img width="300px" height="300px" class="img-fluid" src="{{ asset('portal/images/XMLID_1170_.png') }}" alt="">
                </div>
                <div class="col-lg-7">
                    <img class="img-fluid flouting-img" src="{{ asset('portal/images/Rectangle (2).png') }}" alt="">
                </div>
            </div>
        </div>
    </section>
    <section id="fifth-section">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-3 col-6 text-end">
                    <img class="img-fluid" src="{{ asset('portal/images/Frame 1261154552.png') }}" alt="">
                </div>
                <div class="col-md-5 text-center">
                    <h2>Download Now And get on touch</h2>
                    <div class="fifth-section-buttons">
                        <a target="_blank"  href="https://play.google.com/store/apps/details?id=io.flyeasy.teams">
                                <img class="img-fluid" src="{{ asset('portal/images/en_badge_web_generic.png') }}" alt="" srcset="">
                        </a>
                        <a target="_blank" href="https://apps.apple.com/eg/app/team-layered/id6503207368">
                            <img class="img-fluid" src="{{ asset('portal/images/Download_on_the_App_Store_Badge.svg.png') }}" alt="" srcset="">
                        </a>
                    </div>
                </div>
                <div class="col-md-3 col-6  text-start">
                    <img class="img-fluid" src="{{ asset('portal/images/Frame 1261154551.png') }}" alt="">
                </div>
            </div>
        </div>
    </section>
    <section id='sixth-section'>
        <div class="container">
            <h2 class="section-head" >{{ __('How to Use') }}</h2>
            <div class="row">
                <div class="col-lg-6">
                    <div class="sixth-section-video">
                        <h3>{{ __('How to Create an Account') }}</h3>
                        <div>
                            <iframe src="https://www.youtube.com/embed/mc7C7OFLg4g?si=-Cy0T6dXUa0TJiuw" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="sixth-section-video">
                        <h3>{{ __('How to Operate') }}</h3>
                        <div>
                            <iframe src="https://www.youtube.com/embed/hJlWkN7Iz_o?si=Ll0o1S-fM3jepdTk" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer  id="footer">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <a href="mailto:flyeasy.apps@gmail.com"> <p> <i class="fa-regular fa-envelope me-3"></i> flyeasy.apps@gmail.com</p> </a>
                    <a href="tell:+201005777321">  <p class="mb-0" > <i class="fa-solid fa-phone me-3"></i> +201005777321</p> </a>
                </div>
                <div class="col-sm-6 text-end">
                    <a class="navbar-brand" href="#Home"> <img src="{{ asset('portal/images/final logo 1.png') }}"  alt=""/>  {{ __('portal.FlyEasy') }} </a>
                    <ul class="social-links">
                        <li><a href="#" target="_blank" > <i class="fa-brands fa-facebook-f"></i></a></li>
                        <li><a href="#" target="_blank" > <i class="fa-brands fa-linkedin-in"></i></a></li>
                        <li><a href="#" target="_blank" > <i class="fa-brands fa-twitter"></i></a></li>
                    </ul>
                </div>
            </div>
            <p class="copyright">Copyright &copy;  FlyEasy 2024 All right reserved </p>
        </div>
        {{-- <div style="margin-left: 140px">
            <svg style="color: white" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
            </svg>
            <span style="color: white; margin-left: 10px">flyeasy.apps@gmail.com</span>
            <svg style="color: white" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
            </svg>
            <span style="color: white; margin-left: 10px">+201005777321</span>
        </div>
        <div class="col-lg-3">
            <p class="df">Copyright &copy; <br> FlyEasy 2024 All right reserved </p>
        </div>
        <div>
            <div class="kl">
                <div>
                    <img class="sw" src="{{ asset('portal/images/final logo 1.png') }}"  alt=""/>
                    <span class="x">{{ __('portal.FlyEasy') }}</span>
                </div>
                <img  class="ds" src="{{ asset('portal/images/Social.png') }}" alt="" srcset="">
            </div>
        </div> --}}
    </footer>
@endsection
