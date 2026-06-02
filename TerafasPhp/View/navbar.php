<nav>
    <a href="?p=dashboard">TerafasPhp</a>
    <ul>
        <li><a href="?p=dashboard">Dashboard</a></li>
        <li><a href="?p=add">Nova Tarefa</a></li>
        <li><a href="?p=logout">Sair</a></li>
    </ul>
    <span>Olá, <?= htmlspecialchars($_SESSION['nome']) ?></span>
</nav>
