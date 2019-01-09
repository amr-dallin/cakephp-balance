<?php
$this->start('script');
echo $this->Html->script(array(
    'Balance./vendors/DataTables/datatables.min',
    'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js'
));
$this->end();
?>

<?php $this->start('script-code'); ?>
<script type="text/javascript">
    $(document).ready(function () {        
        <?php foreach($statistics as $statistic): ?>
        var verbs<?php echo $statistic['Currency']['id']; ?> = new Chart($('#expenditureStatistics<?php echo $statistic['Currency']['id']; ?>'), {
            type: 'bar',
            data: {
                labels: <?php echo $statistic['Graph']['labels']; ?>,
                datasets: <?php echo $statistic['Graph']['datasets']; ?>
                
            },
            options: {
                responsive: true,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
        <?php endforeach; ?>
    });
</script>
<?php $this->end(); ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <?php echo __('Statistics'); ?>
                <ul class="nav nav-tabs pull-right" role="tablist">
                    <?php foreach($statistics as $key => $statistic): ?>
                    <li class="nav-item">
                        <a href="#s<?php echo $statistic['Currency']['id']; ?>" 
                           data-toggle="tab" 
                           data-ident="verbs<?php echo $statistic['Currency']['id']; ?>" 
                           aria-expanded="true"
                           class="nav-link <?php if ($key == 0) echo 'active show'; ?>"
                        ><?php echo $statistic['Currency']['title']; ?></a>
                    </li>
                    <?php endforeach; ?>

                </ul>
            </div>
            <div class="card-body">                
                <div class="tab-content">
                    <?php foreach($statistics as $key => $statistic): ?>
                    <div class="tab-pane <?php if ($key == 0) echo 'active show'; ?>" id="s<?php echo $statistic['Currency']['id']; ?>">
                        <div class="row no-space">
                            <canvas id="expenditureStatistics<?php echo $statistic['Currency']['id']; ?>" width="800" height="200"></canvas>
                        </div>
                            <div class="row">
                                <?php if (isset($statistic['Total']['Earning'])): ?>
                                <div class="col-md-6 pull-right">
                                    <div class="h3 text-right">
                                        <strong><?php echo __('Total Earning:'); ?>  
                                            <span class="text-success">
                                                <?php 
                                                echo $this->Price->currency(
                                                    $statistic['Total']['Earning'], 
                                                    $statistic['Currency']['symbol']
                                                );
                                                ?>
                                            </span>
                                        </strong>
                                    </div>
                                </div>
                                <?php endif; ?>
                                
                                <?php if (isset($statistic['Total']['Expense'])): ?>
                                <div class="col-md-6 pull-right">
                                    <div class="h3 text-right">
                                        <strong><?php echo __('Total Expense:'); ?>  
                                            <span class="text-info">
                                                <?php 
                                                echo $this->Price->currency(
                                                    $statistic['Total']['Expense']['total'], 
                                                    $statistic['Currency']['symbol']
                                                );
                                                ?>
                                            </span>
                                        </strong>
                                    </div>
                                    <?php if ($statistic['Total']['Expense']['excess'] != 0): ?>
                                    <div class="h5 text-right">
                                        <strong><?php echo __('Excess:'); ?>  
                                            <span class="text-danger">
                                                    <?php 
                                                    echo $this->Price->currency(
                                                        $statistic['Total']['Expense']['excess'], 
                                                        $statistic['Currency']['symbol']
                                                    );
                                                    ?>
                                            </span>
                                        </strong>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>
                            </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>