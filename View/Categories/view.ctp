<?php
$title = __('Category «%s»', h($category['Category']['title']));

$this->assign('title', $title);

$this->start('breadcrumb');
$breadcrumbs = $this->Balance->breadcrumbsCategory($title, $getPath);
echo $this->element('breadcrumb', array('breadcrumbs' => $breadcrumbs));
$this->end();

$this->start('sidebar');
$menu['settings'][1][2] = true;
echo $this->element('sidebar', array('menu' => $menu));
$this->end();

$this->start('css');
echo $this->Html->css('Balance./vendors/DataTables/datatables.min');
$this->end();

$this->start('script');
echo $this->Html->script('Balance./vendors/DataTables/datatables.min');
$this->end();
?>

<?php $this->start('script-code'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#dt_basic').DataTable({
            responsive: true,
            bSort: false
        });
    });
</script>
<?php $this->end(); ?>

<?php echo $this->element('statistics', array('statistics' => $statistics)); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> <?php echo __('Child Categories List'); ?></div>
            <div class="card-body">
                <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                    <thead>
                        <tr>
                            <th style="background: none; cursor: inherit; width: 3%;"></th>
                            <th data-class="expand" style="width: 40%;"><?php echo __('Title'); ?></th>
                            <th data-hide="phone,tablet" style="width: 8%;"><?php echo __('Created'); ?></th>
                            <th style="background: none; cursor: inherit; width: 3%;"></th>
                            <th style="background: none; cursor: inherit; width: 3%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($category['ChildCategory'] as $key => $category): ?>
                        <tr>
                            <td class="text-center">
                                <?php
                                echo $this->Html->link(
                                    $this->Html->tag('i', '', array(
                                        'class' => 'fa fa-lg fa-eye'
                                    )),
                                    array('action' => 'view', h($category['id'])),
                                    array('escape' => false)
                                );
                                ?>
                            </td>
                            <td><?php echo h($category['title']); ?></td>
                            <td>
                                <?php 
                                echo $this->Balance->dateFormat('d M Y',
                                    h($category['created'])
                                );
                                ?>
                            </td>

                            <td class="text-center">
                                <?php
                                echo $this->Html->link(
                                    $this->Html->tag('i', '', array(
                                        'class' => 'fa fa-lg fa-pencil'
                                    )),
                                    array('action' => 'edit', h($category['id'])),
                                    array('escape' => false)
                                );
                                ?>
                            </td>
                            <td class="text-center">
                                <?php
                                echo $this->Form->postLink(
                                    $this->Html->tag('i', '', array(
                                        'class' => 'fa fa-lg fa-trash-o'
                                    )),
                                    array('action' => 'delete', h($category['id'])),
                                    array('escape' => false,
                                        'confirm' => __('Are you sure you want to delete?'), 
                                    )
                                );
                                ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>