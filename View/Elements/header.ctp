<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <?php
    echo $this->Html->link(__('Balance'),
        array('controller' => 'pages', 'action' => 'display'),
        array('class' => 'navbar-brand')
    );
    ?>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="nav navbar-nav d-md-down-none">
        <li class="nav-item px-3">
            <?php
            echo $this->Html->link(__('Add Expense(s)'),
                array('controller' => 'expenses', 'action' => 'add'), 
                array('class' => 'nav-link')
            );
            ?>
        </li>
        <li class="nav-item px-3">
            <?php
            echo $this->Html->link(__('Add Earning'),
                array('controller' => 'earnings', 'action' => 'add'),
                array('class' => 'nav-link')
            );
            ?>
        </li>
        <li class="nav-item px-3">
            <?php
            echo $this->Html->link(__('Add Category'),
                array('controller' => 'categories', 'action' => 'add'),
                array('class' => 'nav-link')
            );
            ?>
        </li>
    </ul>
    <ul class="nav navbar-nav ml-auto"></ul>
</header>