<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
?>

<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item <?php if (isset($menu['dashboard'])) echo 'active open'; ?>">
                <?php
                echo $this->Html->link(
                    $this->Html->tag('i', '', array('class' => 'fa fa-lg fa-fw fa-home')) . ' ' . 
                    __('Dashboard'),
                    array('controller' => 'pages', 'action' => 'display'), 
                    array('escape' => false, 'class' => 'nav-link')
                );
                ?>
            </li>
            <li class="nav-item nav-dropdown <?php if (isset($menu['expenses'])) echo 'active open'; ?>">
                <?php 
                echo $this->Html->link(
                    $this->Html->tag('i', '', array('class' => 'fa fa-lg fa-fw fa-book')) . ' ' . 
                    __('Expenses'),
                    '#',
                    array('escape' => false, 'class' => 'nav-link nav-dropdown-toggle')
                );
                ?>
                <ul class="nav-dropdown-items">
                    <li class="nav-item <?php if (isset($menu['expenses'][0])) echo 'active'; ?>">
                        <?php
                        echo $this->Html->link(__('Add Expense(s)'), 
                            array('controller' => 'expenses', 'action' => 'add'), 
                            array('class' => 'nav-link')
                        );
                        ?>
                    </li>
                    <li class="nav-item <?php if (isset($menu['expenses'][1])) echo 'active'; ?>">
                        <?php
                        echo $this->Html->link(__('Expenses List'), 
                            array('controller' => 'expenses', 'action' => 'index'),
                            array('class' => 'nav-link')
                        );
                        ?>
                    </li>
                </ul>
            </li>

            <li class="nav-item nav-dropdown <?php if (isset($menu['earnings'])) echo 'active open'; ?>">
                <?php
                echo $this->Html->link(
                    $this->Html->tag('i', '', array('class' => 'fa fa-lg fa-fw fa-bank')) . ' ' . 
                    __('Earnings'),
                    '#', 
                    array('escape' => false, 'class' => 'nav-link nav-dropdown-toggle')
                );
                ?>
                <ul class="nav-dropdown-items">
                    <li class="nav-item <?php if (isset($menu['earnings'][0])) echo 'active'; ?>">
                        <?php
                        echo $this->Html->link(__('Add Earning'), 
                            array('controller' => 'earnings', 'action' => 'add'), 
                            array('class' => 'nav-link')
                        );
                        ?>
                    </li>
                    <li class="nav-item <?php if (isset($menu['earnings'][1])) echo 'active'; ?>">
                        <?php
                        echo $this->Html->link(__('Earning List'), 
                            array('controller' => 'earnings', 'action' => 'index'),
                            array('class' => 'nav-link')
                        );
                        ?>
                    </li>
                </ul>
            </li>

            <li class="nav-item nav-dropdown <?php if (isset($menu['exchanges'])) echo 'active open'; ?>">
                <?php
                echo $this->Html->link(
                    $this->Html->tag('i', '', array('class' => 'fa fa-lg fa-fw fa-exchange')) . ' ' . 
                    __('Exchanges'),
                    '#', 
                    array('escape' => false, 'class' => 'nav-link nav-dropdown-toggle')
                );
                ?>
                <ul class="nav-dropdown-items">
                    <li class="nav-item <?php if (isset($menu['exchanges'][0])) echo 'active'; ?>">
                        <?php
                        echo $this->Html->link(__('Add Exchange'), 
                            array('controller' => 'exchanges', 'action' => 'add'), 
                            array('class' => 'nav-link')
                        );
                        ?>
                    </li>
                    <li class="nav-item <?php if (isset($menu['exchanges'][1])) echo 'active'; ?>">
                        <?php
                        echo $this->Html->link(__('Exchange List'), 
                            array('controller' => 'exchanges', 'action' => 'index'),
                            array('class' => 'nav-link')
                        );
                        ?>
                    </li>
                </ul>
            </li>

            <li class="nav-item nav-dropdown <?php if (isset($menu['discrepancies'])) echo 'active open'; ?>">
                <?php
                echo $this->Html->link(
                    $this->Html->tag('i', '', array('class' => 'fa fa-lg fa-fw fa-warning')) . ' ' . 
                    __('Discrepancies'),
                    '#', 
                    array('escape' => false, 'class' => 'nav-link nav-dropdown-toggle')
                );
                ?>
                <ul class="nav-dropdown-items">
                    <li class="nav-item <?php if (isset($menu['discrepancies'][0])) echo 'active'; ?>">
                        <?php
                        echo $this->Html->link(__('Add Discrepancies'), 
                            array('controller' => 'discrepancies', 'action' => 'add'), 
                            array('class' => 'nav-link')
                        );
                        ?>
                    </li>
                    <li class="nav-item <?php if (isset($menu['discrepancies'][1])) echo 'active'; ?>">
                        <?php
                        echo $this->Html->link(__('Discrepancy List'), 
                            array('controller' => 'discrepancies', 'action' => 'index'),
                            array('class' => 'nav-link')
                        );
                        ?>
                    </li>
                </ul>
            </li>

            <li class="nav-item nav-dropdown <?php if (isset($menu['settings'])) echo 'active open'; ?>">
                <?php 
                echo $this->Html->link(
                    $this->Html->tag('i', '', array('class' => 'fa fa-lg fa-fw fa-cog')) . ' ' . 
                    __('Settings'),
                    '#', 
                    array('escape' => false, 'class' => 'nav-link nav-dropdown-toggle')
                );
                ?>
                <ul class="nav-dropdown-items">
                    <li class="nav-item nav-dropdown <?php if (isset($menu['settings'][0])) echo 'active'; ?>">
                    <?php 
                    echo $this->Html->link(
                        $this->Html->tag('i', '', array('class' => 'fa fa-lg fa-fw fa-money')) . ' ' . 
                        __('Currencies'),
                        '#', 
                        array('escape' => false, 'class' => 'nav-link nav-dropdown-toggle')
                    );
                    ?>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item <?php if (isset($menu['settings'][0][1])) echo 'active'; ?>">
                            <?php
                            echo $this->Html->link(__('Add Currency'),
                                array('controller' => 'currencies', 'action' => 'add'),
                                array('class' => 'nav-link')
                            );
                            ?>
                            </li>
                            <li class="nav-item <?php if (isset($menu['settings'][0][2])) echo 'active'; ?>">
                            <?php
                            echo $this->Html->link(__('Currencies List'),
                                array('controller' => 'currencies', 'action' => 'index'),
                                array('class' => 'nav-link')
                            );
                            ?>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown <?php if (isset($menu['settings'][1])) echo 'active'; ?>">
                    <?php 
                    echo $this->Html->link(
                        $this->Html->tag('i', '', array('class' => 'fa fa-lg fa-fw fa-database')) . ' ' . 
                        __('Categories'),
                        '#', 
                        array('escape' => false, 'class' => 'nav-link nav-dropdown-toggle')
                    );
                    ?>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item <?php if (isset($menu['settings'][1][1])) echo 'active'; ?>">
                            <?php
                            echo $this->Html->link(__('Add Category'),
                                array('controller' => 'categories', 'action' => 'add'),
                                array('class' => 'nav-link')
                            );
                            ?>
                            </li>
                            <li class="nav-item <?php if (isset($menu['settings'][1][2])) echo 'active'; ?>">
                            <?php
                            echo $this->Html->link(__('Categories List'),
                                array('controller' => 'categories', 'action' => 'index'),
                                array('class' => 'nav-link')
                            );
                            ?>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>