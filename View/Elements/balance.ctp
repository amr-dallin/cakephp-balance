<?php
$balance = $this->requestAction(array(
    'controller' => 'currencies', 'action' => 'balance'
));
?>

<?php if (!empty($balance)): ?>
<div class="row">
    <?php foreach($balance as $currency): ?>
    <?php
    if ($currency['total'] == 0) {
        continue;
    }
    ?>
    <div class="col-6 col-lg-2">
        <div class="card">
            <div class="card-body p-2 d-flex align-items-center">
                <div>
                    <div class="text-value-sm text-primary">
                        <?php
                        echo $this->Price->currency($currency['total'],
                            $currency['Currency']['symbol']
                        );
                        ?>
                    </div>
                    <div class="text-muted text-uppercase font-weight-bold small">
                        <?php echo $currency['Currency']['codeIso']; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.col-->
    <?php endforeach; ?>
</div>
<?php endif; ?>