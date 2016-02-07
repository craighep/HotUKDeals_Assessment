<?php
    $url = "http://craighep.co.uk/argos/api/getHottestDeals.php?action=argosDeals";
    $response = file_get_contents($url);
    $deals = json_decode($response, true);
    ?>
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="keywords" content=
            "Argos hot deals" />
        <meta name="description" content=
            "Argos hot deals" />
        <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
        <title>Argos Deal Comparison</title>
        <link rel="shortcut icon" href="img/favicon.ico">
        <link href="css/main.css" rel="stylesheet">
        <link rel="stylesheet" href="css/foundation.min.css">
    </head>
    <body>
        <div class="title">
            <div class="row">
                <div id="featured">
                    <div class="large-12 medium-12 small-12 columns">
                        <h2 class="title-heading">HotUKDeals Argos price compare</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="medium-6 large-4 columns">
                <h1>Biggest saving</h1>
                <a data-open="more">
                <img class="deal_image large hover" src="<?php echo $deals[0][image];?>" alt="featured">
                </a>
                <i>Click image for details</i>
                <div class="reveal" id="more" data-reveal>
                    <h3><?php echo$deals[0][title]?></h3>
                    <hr>
                    <div class="row">
                        <div class="medium-6 large-4 columns">
                            <img class="deal_image large" alt="featured small" src="<?php echo $deals[0][image];?>">
                        </div>
                        <div class="medium-6 large-8 columns">
                            <p><?php echo $deals[0][description];?>
                        </div>
                    </div>
                    <button class="close-button" data-close aria-label="Close reveal" type="button">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="medium-6 large-8 columns">
                <div id="hottest">
                    <div class="rank">1</div>
                    <i class="flame"></i>
                    <div class="temperature"><a target="_blank" href="<?php echo $deals[0][dealLink]?>"><b><?php echo $deals[0][temperature]?>&deg;</b></a></div>
                    <hr>
                    <div class="description">
                        <p class="lead">
                            <a target="_blank" href="<?php echo $deals[0][productLink]?>"><?php echo $deals[0][title]?></a>
                        </p>
                    </div>
                    <table class="prices">
                        <tr>
                            <td>Best Buy price: </td>
                            <td class="bb_price">£<?php echo number_format($deals[0][altPrice], 2)?></td>
                        </tr>
                        <tr>
                            <td>Argos price: </td>
                            <td class="price"><b>£<?php echo number_format($deals[0][price], 2)?></b></td>
                        </tr>
                        <tr>
                            <td>Saving: </td>
                            <td class="difference"><b>£<?php echo number_format($deals[0][priceDifference], 2)?></b></td>
                        </tr>
                    </table>
                    <div class="linkDeal"><a target="_blank" href="<?php echo $deals[0][dealLink]?>">View deal on HotUKDeals site</a></div>
                    <div class="linkArgos"><a target="_blank" href="<?php echo $deals[0][productLink]?>">View product on Argos site</a></div>
                </div>
            </div>
        </div>
        <div class="row column">
            <hr>
        </div>
        <div class="row column">
            <h2>More top saving deals</h2>
        </div>
        <div class="row small-up-1 medium-up-2 large-up-3">
            <?php 
                for($i = 1; $i < count($deals); $i++) {
                  $deal = $deals[$i]; ?>
            <div class="column">
                <div class="callout">
                    <div class="rank"><?php echo $i+1;?></div>
                    <i class="flame"></i>
                    <div class="temperature"><a target="_blank" href="<?php echo $deal[dealLink]?>"><b><?php echo $deal[temperature]?>&deg;</b></a></div>
                    <div class="lead">
                        <a target="_blank" href="<?php echo $deal[productLink]?>"><?php echo $deal[title]?></a>
                    </div>
                    <hr>
                    <a data-open="more<?php echo $i?>">
                    <img class="deal_image hover" alt="<?php echo$deal[title]?>" src="<?php echo $deal[image];?>">
                    </a>
                    <i>Click image for details</i>
                    <div class="reveal" id="more<?php echo $i?>" data-reveal>
                        <h3><?php echo$deal[title]?></h3>
                        <hr>
                        <div class="row">
                            <div class="medium-6 large-4 columns">
                                <img class="deal_image large" alt="<?php echo$deal[title]?> small" src="<?php echo $deal[image];?>">
                            </div>
                            <div class="medium-6 large-8 columns">
                                <p><?php echo $deal[description];?>
                            </div>
                        </div>
                        <button class="close-button" data-close aria-label="Close reveal" type="button">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <table class="prices">
                        <tr>
                            <td>Best Buy price: </td>
                            <td class="bb_price">£<?php echo number_format($deal[altPrice],2)?></td>
                        </tr>
                        <tr>
                            <td>Argos price: </td>
                            <td class="price"><b>£<?php echo number_format($deal[price],2)?></b></td>
                        </tr>
                        <tr>
                            <td>Saving: </td>
                            <td class="difference"><b>£<?php echo number_format($deal[priceDifference],2)?></b></td>
                        </tr>
                    </table>
                    <div class="linkDeal subheader"><a target="_blank" href="<?php echo $deal[dealLink]?>">View deal on HotUKDeals site</a></div>
                    <div class="linkArgos subheader"><a target="_blank" href="<?php echo $deal[productLink]?>">View product on Argos site</a></div>
                </div>
            </div>
            <?php
                }
                ?>
        </div>
        <br>
        <div id="links">
            <div class="row">
                <div class="medium-12 columns">
                    <p>Prices taken from HotUKDeals, and do not represent those directly on Argos.</p>
                </div>
            </div>
        </div>
        <footer>
            <br>
            <div class="row">
                <div class="small-12 columns">
                    <div class="row">
                        <div class="small-6 columns">
                            <p>
                                Copyright &copy; 
                                <script type="text/javascript">
                                    document.write(new Date().getFullYear());
                                </script>
                                <a href="../">Craig Mathew Heptinstall</a>
                            </p>
                        </div>
                        <div class="small-6 columns">
                            <ul id="footerLinks" class="inline-list right">
                                <li><a target="_blank" href="http://validator.w3.org/check?uri=referer"><img style=
                                    "border:0;width:50px;height:60px" src="img/html.png" alt=
                                    "Valid HTML5!" /></a></li>
                                <li><a target="_blank" href="http://jigsaw.w3.org/css-validator/check/referer"><img style=
                                    "border:0;width:50px;height:60px" src=
                                    "img/css.png" alt="CSS3" />
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <script src="js/vendor/jquery.min.js"></script>
        <script src="js/foundation.min.js"></script>
        <script type="text/javascript"> 
            $(document).foundation();
        </script>
    </body>
</html>
