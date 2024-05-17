<nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-body-tertiary sidebar" style="background-color:#007bff;">
            <div class="sidebar-sticky mt-5">
                <ul class="nav flex-column">
                    <li class="nav-item mb-5">
                        <a class="nav-link dropdown-toggle" href="#" id="apprentisDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Apprentis
                        </a>
                        <div class="dropdown-menu" aria-labelledby="apprentisDropdown" >
                            <a class="dropdown-item" href="{{ route('apprentis.index')}}">Ajouter</a>
                            <a class="dropdown-item" href=" {{ route('apprentis.consulter') }}">Consulter la liste</a>
                        </div>
                    </li>
                    <li class="nav-item mb-5">
                        <a class="nav-link dropdown-toggle" href="#" id="maitresDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Maîtres apprentis
                        </a>
                        <div class="dropdown-menu" aria-labelledby="maitresDropdown">
                            <a class="dropdown-item" href="{{ route('maitreapprentis.index') }}">Ajouter</a>
                            <a class="dropdown-item" href="#">Consulter la liste</a>
                        </div>
                    </li>
                    <li class="nav-item mb-5">
                        <a class="nav-link dropdown-toggle" href="#" id="structuresDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Structures
                        </a>
                        <div class="dropdown-menu" aria-labelledby="structuresDropdown">
                            <a class="dropdown-item" href="{{ route('structures.index') }}">Ajout & Deatils</a>
                        </div>
                    </li>
                    <li class="nav-item mb-5">
                        <a class="nav-link dropdown-toggle" href="#" id="exercicesDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            exercices
                        </a>
                        <div class="dropdown-menu" aria-labelledby="exercicesDropdown">
                            <a class="dropdown-item" href="#">Ajouter</a>
                            <a class="dropdown-item" href="#">Consulter la liste</a>
                        </div>
                    </li>
                    <li class="nav-item mb-5">
                        <a class="nav-link dropdown-toggle" href="#" id="plansDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Plans de besoins
                        </a>
                        <div class="dropdown-menu" aria-labelledby="plansDropdown">
                            <a class="dropdown-item" href="#">Ajouter un plan</a>
                            <a class="dropdown-item" href="#">Consulter les plans</a>
                            <a class="dropdown-item" href="#">Details des plans</a>
                        </div>
                    </li>
                    <li class="nav-item mb-5">
                        <a class="nav-link dropdown-toggle" href="#" id="plansDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Evaluations
                        </a>
                        <div class="dropdown-menu" aria-labelledby="plansDropdown">
                            <a class="dropdown-item" href="#">Ajouter un plan</a>
                            <a class="dropdown-item" href="#">Consulter les plans</a>
                        </div>
                    </li>
                    <li class="nav-item mb-5">
                        <a class="nav-link dropdown-toggle" href="#" id="plansDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Assiduites
                        </a>
                        <div class="dropdown-menu" aria-labelledby="plansDropdown">
                            <a class="dropdown-item" href="#">Ajouter une assiduité</a>
                            <a class="dropdown-item" href="#">Consulter les assiduités</a>
                        </div>
                    </li>
                    <li class="nav-item mb-5">
                        <a class="nav-link dropdown-toggle" href="#" id="plansDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Departs
                        </a>
                        <div class="dropdown-menu" aria-labelledby="plansDropdown">
                            <a class="dropdown-item" href="#">Ajouter une depart</a>
                            <a class="dropdown-item" href="#">Consulter les departs</a>
                        </div>
                    </li>
                    <li class="nav-item mb-5">
                        <a class="nav-link dropdown-toggle" href="#" id="plansDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Parametres
                        </a>
                        <div class="dropdown-menu" aria-labelledby="plansDropdown">
                            <a class="dropdown-item" href="#">Ajouter une parametre</a>
                            <a class="dropdown-item" href="#">Consulter les parametres</a>
                        </div>
                    </li>
                    <li class="nav-item mb-5">
                        <a class="nav-link dropdown-toggle" href="#" id="comptesDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Comptes
                        </a>
                        <div class="dropdown-menu" aria-labelledby="comptesDropdown">
                            <a class="dropdown-item" href="#">Ajouter des comptes</a>
                            <a class="dropdown-item" href="#">Consulter les comptes</a>
                        </div>
                    </li>
                    <li class="nav-item mb-5">
                        <a class="nav-link" href="{{ url('/profile') }}">
                            Profile
                        </a>
                    </li>
                    <li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>