<footer id="footer" data-aos="fade-up">

    <!--<div class="footer-newsletter">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <h4>Inscrivez-vous à notre newsletter</h4>
                    <p>Restez à jour de la large gamme de services que nous proposons. Profitez également des annonces des prochaines formations dans le domaine de la gestion.</p>
                    <form action="" method="post">
                        <input type="email" name="email" placeholder="Entrez votre adresse e-mail"><input type="submit" value="S'inscrire" class="hvr-grow">
                    </form>
                </div>
            </div>
        </div>
    </div>-->

    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-4 col-md-4 col-12 footer-contact">
                    <h3>Rsoft Réunion</h3>
                    <p>
                        {!! $infos->address !!}<br><br>
                        <strong>Phone:</strong> {{ $infos->phone }}<br>
                        <strong>Email:</strong> {{ $infos->email }}<br>
                    </p>
                </div>

                <div class="col-lg-4 col-md-4 col-12 footer-links">
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="/nos-succes">Nos succès</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="/politique-de-confidentialite">Politique de confidentialité</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="/mentions-legales">Mentions légales</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-4 col-12 footer-links">
                    <h4>Outil de prise en main à distance</h4>
                    <p>Offrir une expérience améliorée et plus innovante afin de rendre votre interaction avec notre entreprise plus fluide et efficace, c'est la nôtre objectif.</p>
                    <div class="text-center">
                        <a href="https://www.rsoft.re/documents/rustdesk-host=rsoft.selfip.net,key=JrMb6txDaOfvRU7qByVC1pm4oy1uOm0iGew+u8paolY=.exe" download="rustdesk-host=rsoft.selfip.net,key=JrMb6txDaOfvRU7qByVC1pm4oy1uOm0iGew+u8paolY=.exe" class="hvr-grow btn-get-started scrollto" style="font-size: 12px;"><i class="fa-solid fa-download fa-fw"></i> Télécharger notre outil de prise en main</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container footer-bottom clearfix">
        <div class="copyright">
            &copy; Copyright <strong><span>RSOFT RÉUNION - {{ now()->year }}</span></strong>.
        </div>
        <div class="credits">
            Développé par <strong><a href="http://www.rsoft.re/" target="_blank" class="text-link">RSOFT RÉUNION</a></strong>
        </div>
    </div>
</footer>
