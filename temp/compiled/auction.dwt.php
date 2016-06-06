<!DOCTYPE html>
<html lang="en">
<head>
<base href="http://localhost/" />
<meta name="author" content="先知教育-IT培训 QQ:276906866" />
	<meta charset="UTF-8">
	<?php echo $this->fetch('library/header.lbi'); ?>
	<title><?php echo $this->_var['page_title']; ?></title>
	<meta name="Keywords" content="<?php echo $this->_var['keywords']; ?>" />
    <meta name="Description" content="<?php echo $this->_var['description']; ?>" />
    <link href="css/jquery.jqzoom.css" rel="stylesheet" type="text/css">
</head>
<body>
	<?php echo $this->fetch('library/page_paimai_header.lbi'); ?>
	<div id="nymain">
	    <?php echo $this->fetch('library/ur_here.lbi'); ?>
        <div class="auction w">
            <div class="l">
                <div class="head">
                    <div class="img">
                        <div class="goods_img"><a href="<?php echo $this->_var['pictures']['0']['img_original']; ?>" class="jqzoom" rel='gal1' title="triumph" id="jqzoom1">
                          <?php if ($this->_var['pictures']): ?>
                          <img src="<?php echo $this->_var['pictures']['0']['img_url']; ?>" />
                          <?php endif; ?>
                          </a> </div>
                        <div style="height:10px; line-height:10px; clear:both;"></div>
                        
                        <?php echo $this->fetch('library/auction_gallery.lbi'); ?>
                        
                    </div>
                    <div class="info">
                        <h1><?php echo htmlspecialchars($this->_var['auction']['act_name']); ?></h1>
                        <div class="status">

                            <?php if ($this->_var['auction']['status_no'] == 0): ?>
                            <div class="paimai">尚未开始</div>
                            <div class="time" data-startTime="<?php echo $this->_var['auction']['gmt_start_time']; ?>" data-endTime="<?php echo $this->_var['auction']['gmt_end_time']; ?>"><?php echo $this->_var['lang']['please_waiting']; ?></div>
                            <?php elseif ($this->_var['auction']['status_no'] == 1): ?>
                            <div class="paimai">正在进行</div>
                            <div class="time" data-startTime="<?php echo $this->_var['auction']['gmt_start_time']; ?>" data-endTime="<?php echo $this->_var['auction']['gmt_end_time']; ?>"><?php echo $this->_var['lang']['please_waiting']; ?></div>
                            <?php else: ?>
                            <div class="paimai">拍卖结束</div>
                            <div class="time">结束时间:<?php echo $this->_var['auction']['end_time']; ?></div>
                            <?php endif; ?>

                            <div class="people">
                                <span class="cj"><em><?php echo $this->_var['auction_log_count']; ?></em>次出价</span>
                                <span class="wg"><em><?php echo $this->_var['auction']['act_count']; ?></em>次围观</span>
                                <span class="wg">起拍价:<em>￥<?php echo $this->_var['auction']['formated_start_price']; ?></em></span>
                                <span class="wg">保证金:<em>￥<?php echo $this->_var['auction']['formated_deposit']; ?></em></span>
                            </div>
                        </div>
                        <div class="start">
                            <div class="dqj">当前价：<span>￥<?php echo $this->_var['auction']['formated_current_price']; ?></span><span id="dqj"><?php echo $this->_var['auction']['current_price']; ?></span></div>
                            <?php if ($this->_var['auction']['status_no'] == 0): ?>
                            <div class="swks"><?php echo $this->_var['auction']['start_time']; ?>开始</div>
                            <?php elseif ($this->_var['auction']['status_no'] == 1): ?>
                            <?php if ($_SESSION['user_id']): ?>
                            <div class="cj">
                                <form name="theForm" action="auction.php" method="post" onsubmit="return checkchujiaform()">
                                    出&nbsp;&nbsp;&nbsp;&nbsp;价：
                                    <input type="text" value="￥" disabled class="inputBg" id="zzjg" >
                                    <input type="hidden" value="" name="price" id="zzjg2" >
                                    <input name="bid" type="submit" class="bnt_blue" value="<?php echo $this->_var['lang']['button_bid']; ?>"/>

                                    <input name="act" type="hidden" value="bid" />
                                    <input name="id" type="hidden" value="<?php echo $this->_var['auction']['act_id']; ?>" />
                                    <input name="act_count" type="hidden" value="<?php echo $this->_var['auction_log_count']; ?>" />
                                </form>
                            </div>
                            <div class="cjkj" id="cjkj">
                                <a data-cj="10">+10元</a><a data-cj="50">+50元</a><a data-cj="100">+100元</a><a data-cj="200">+200元</a>
                            </div>
                            <?php else: ?>
                            <div class="qdl"><a href="user.php">本次拍品仅供注册会员参与</a></div>
                            <?php endif; ?>
                            <?php else: ?>
                            <?php if ($this->_var['auction']['is_winner']): ?>
                            <div class="jsgm">
                                <?php if ($this->_var['auction']['closed']): ?>
                                <span>拍卖结束超过24小时,交易关闭</span>
                                <?php elseif ($this->_var['auction']['is_finished']): ?>
                                <span>恭喜您已成功购买此拍品</span>
                                <?php else: ?>
                                <span><?php echo $this->_var['lang']['au_is_winner']; ?></span>
                                <form name="theForm" action="auction.php" method="post" target="_blank">
                                <input name="buy" type="submit" class="bnt_blue_1" value="<?php echo $this->_var['lang']['button_buy']; ?>" />
                                <input name="act" type="hidden" value="buy" />
                                <input name="id" type="hidden" value="<?php echo $this->_var['auction']['act_id']; ?>" />
                                </form>
                                <?php endif; ?>
                            </div>
                            <?php else: ?>

                            <?php if ($this->_var['auction_log_count'] > 0): ?>
                            <?php if ($_SESSION['user_id']): ?>
                            <div class="pmjs">
                                <?php echo $this->_var['lang']['au_finished']; ?>，<?php echo $this->_var['lang']['au_final_bid_not_you']; ?>
                            <?php else: ?>
                            <div class="gx">恭喜<?php echo $this->_var['auction']['user_name']; ?>成功拍到此商品
                            <?php endif; ?>
                            <?php else: ?>
                            <div class="pmjs">
                                <?php echo $this->_var['lang']['au_finished']; ?>，此商品流拍
                            <?php endif; ?>
                            </div>
                            <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="beizhu">
                            <ul>
                                <li>参与资格： </li>
                                <li>本次拍卖仅支持注册会员参与</li>

                            </ul>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="more">
                    <div class="jplc"><a href="article.php?id=67" target="_blank"></a><a href="user.php" target="_blank"></a></div>
                    <div class="info">
                        <ul id="tab_hd">
                            <li class="curr">拍品描述</li>
                            <li>出价记录</li>
                            <li>卖家承诺</li>
                        </ul>
                        <div class="clear"></div>
                        <ul id="tab_bd">
                            <li class="curr"><?php echo $this->_var['auction_goods']['goods_desc']; ?></li>
                            <li>
                                <dl class="chujiajilu">
                                    <dt>
                                         <span class="status">状态</span>
                                         <span class="price">价格</span>
                                         <span class="user">竞拍人</span>
                                         <span class="time">时间</span>
                                    </dt>
                                    <?php $_from = $this->_var['auction_log']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'log');$this->_foreach['fe_bid_log'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['fe_bid_log']['total'] > 0):
    foreach ($_from AS $this->_var['log']):
        $this->_foreach['fe_bid_log']['iteration']++;
?>
                                    <dd<?php if ($this->_foreach['fe_bid_log']['iteration'] == 1): ?> class="get"<?php endif; ?>>
                                        <span class="status">
                                        <?php if ($this->_foreach['fe_bid_log']['iteration'] == 1): ?>领先
                                        <?php else: ?>出局<?php endif; ?>
                                        </span>
                                        <span class="price">¥<em class="pm-num"><?php echo $this->_var['log']['formated_bid_price']; ?></em></span>
                                        <span class="user"><?php echo $this->_var['log']['user_name']; ?></span>
                                        <span class="time"><em class="pm-num"><?php echo $this->_var['log']['formated_bid_time']; ?></em></span>
                                    </dd>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                </dl>
                            </li>
                            <li>
                                <p>服务承诺<br>

                                A.作者本人委托作品或经专家鉴定作品，作品介绍备注栏注明“保真”。<br>
                                B. 商家未经认证或无能力认证作品以实物为准，不负责瑕疵。

                                </p>
                            </li>
                        </ul>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            <div class="r">
                <div class="seller">
                    <p>送拍机构：<?php echo $this->_var['brand_info']['brand_name']; ?></p>
                    <p>历史拍品<em><?php echo $this->_var['brand_info']['total']; ?></em>件</p>
                    <div class="kefu"><a href="tencent://message/?uin=3387089776">在线客服</a></div>
                </div>
                <div class="jilu">
                    <h3>出价记录(<?php echo $this->_var['auction_log_count']; ?>)</h3>
                    <dl>
                        <dt>
                             <span class="status">状态</span>
                             <span class="price">价格</span>
                             <span class="user">竞拍人</span>
                             <span class="time">时间</span>
                        </dt>
                        <?php $_from = $this->_var['auction_log']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'log');$this->_foreach['fe_bid_log'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['fe_bid_log']['total'] > 0):
    foreach ($_from AS $this->_var['log']):
        $this->_foreach['fe_bid_log']['iteration']++;
?>
                        <dd<?php if ($this->_foreach['fe_bid_log']['iteration'] == 1): ?> class="get"<?php endif; ?>>
                            <span class="status">
                            <?php if ($this->_foreach['fe_bid_log']['iteration'] == 1): ?>领先
                            <?php else: ?>出局<?php endif; ?>
                            </span>
                            <span class="price">¥<em class="pm-num"><?php echo $this->_var['log']['formated_bid_price']; ?></em></span>
                            <span class="user"><?php echo $this->_var['log']['user_name']; ?></span>
                            <span class="time"><em class="pm-num"><?php echo $this->_var['log']['formated_bid_time']; ?></em></span>
                        </dd>
                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    </dl>
                    <a class="seemore" id="seemore">查看更多&gt;</a>
                    <div class="clear"></div>
                </div>
                
                <?php echo $this->fetch('library/recommend_best.lbi'); ?>
                
            </div>
            <div class="clear"></div>
        </div>
	</div>
    <?php echo $this->fetch('library/page_paimai_footer.lbi'); ?>
    <script type="text/javascript" src="themes/paimai/js/jquery-1.6.js"></script>
    <script type="text/javascript" src="themes/paimai/js/jquery.jqzoom-core.js"></script>
    <script type="text/javascript">

        $(document).ready(function () {
            $('#jqzoom1').jqzoom({
                zoomType: 'standard',
                lens: true,
                preloadImages: false,
                alwaysOn: false,
                zoomWidth:350,
                zoomHeight:350,
                title:false,
                showPreload:false
            });
        });
    </script>
    <script type="text/javascript" src="themes/paimai/js/setHdTime.js"></script>
<a href="http://www.itmba.cc" style="display:none">先知教育 淄博PHP培训</a>
</body>
</html>