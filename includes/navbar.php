<nav id="mainNavbar" class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow-sm rounded-lg">
    <div class="container-fluid">
        <!-- Navbar Brand/Logo -->
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="./assets/img/logo.png" alt="Your Logo" width="60px" height="32" class="d-inline-block align-text-top rounded-md me-2">
            <!-- <span class="fw-bold text-primary">YourBrand</span> -->
        </a>

        <!-- Container for Login Button and Toggler to control their order -->
        <div class="d-flex order-lg-2">
            <!-- Login Button -->
            <!-- <a href="#" class="login-btn rounded-md">
<i class="fas fa-user-circle"></i> 
LOGIN
</a> -->

            <!-- Navbar Toggler for mobile -->
            <button id="navbarToggler" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <!-- Navbar Collapse Content -->
        <div class="collapse navbar-collapse order-lg-1" id="navbarNavDropdown">
            <ul id="navbarNav" class="navbar-nav ms-auto"> <!-- ms-auto pushes items to the right -->
                <li class="nav-item">
                    <a class="nav-link active rounded-md hover:bg-gray-200 px-3 py-2" aria-current="page" href="home">
                        <i class="fa fa-home" aria-hidden="true"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rounded-md hover:bg-gray-200 px-3 py-2" href="pesquisa">Encontre um(a) profissional</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rounded-md hover:bg-gray-200 px-3 py-2" href="beneficios">Benefícios do(a) associado(a)</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle rounded-md hover:bg-gray-200 px-3 py-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        A ATC-PE
                    </a>
                    <ul class="dropdown-menu rounded-md shadow-lg">
                        <li><a class="dropdown-item rounded-md hover:bg-blue-100" href="quem-somos">Quem somos</a></li>
                        <li><a class="dropdown-item rounded-md hover:bg-blue-100" href="gestao">Gestão</a></li>

                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle rounded-md hover:bg-gray-200 px-3 py-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle"></i> ÁREA DO ASSOCIADO
                    </a>
                    <ul class="dropdown-menu rounded-md shadow-lg">
                        <li><span style="font-size: 12px; color:brown; margin-left:6px; ">Exclusivo para associados</span></li>
                        <hr>
                        <li><a class="dropdown-item rounded-md hover:bg-blue-100" href="http://app.associatec.com.br/AreaAssociados/ATCPE"> > Associatec (cursos e Eventos)</a></li>
                        <li><a class="dropdown-item rounded-md hover:bg-blue-100" href="editar-perfil"> > Alterar dados cadastrais (Associados)</a></li>

                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>