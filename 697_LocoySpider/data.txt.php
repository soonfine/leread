<?php
/*-----------------
独立功能PHP程序
开发者：枯叶天
淘宝店铺：669977.TaoBao.com
演示站：www.SBYOU.net
官网：www.669977.net
QQ：1981255858

此页自动判断归类的栏目及完结或者连载状态，可自由添加相关标识
-----------------*/

//归类标识
$caid_Array=array(
	'11'=>'奇幻,玄幻,奇幻玄幻,东方玄幻,上古神话,邪皇魔君,远古神话,西方奇幻,异世大陆,魔法校园,异类兽族,贵族领主,萌动异界,异界征战,领主贵族,亡灵骷髅,玄幻魔法,玄幻小说,奇幻小说,奇幻修真',
	'22'=>'武侠,仙侠,古典仙侠,快意江湖,仙侣奇缘,现代修真,传统武侠,浪子异侠,国术武技,洪荒封神,萌系仙侠,武侠修真,修真小说,武侠小说,仙侠小说',
	'33'=>'都市,青春,言情,豪门世家,都市生活,异术超能,职场丽人,乡土风情,娱乐明星,婚姻家庭,剩男剩女,恩怨情仇,合租情缘,商战风云,职场励志,官场沉浮,谍战特工,现实百态,乡土小说,爱情婚姻,青春校园,花季雨季,萌系纯爱,网络情缘,追星一族,契约婚姻,王子公主,冷帝魅皇,冰山总裁,妃你不可,校园异能,娱乐明星,合租情缘,都市言情,都市小说,言情小说,青春小说',
	'44'=>'历史,军事,架空历史,穿越时空,宫闱风云,古风古韵,家宅情仇,种田经商,江湖情缘,女尊天下,闲话红楼,权谋朝争,上古先秦,秦汉三国,两晋隋唐,五代十国,两宋元明,清史民国,外国历史,历史传记,历史军事,穿越小说,历史小说,历史穿越,军事小说,历史架空',
	'55'=>'游戏,竞技,游戏小说,竞技小说,同人,虚拟网游,数字生命,体育竞技,游戏人生,游戏生涯,电子竞技,游戏异界,体育竞技,篮球运动,足球运动,弈林生涯,同人地带,剧本图文,品味美文,动漫同人,武侠同人,小说同人,授权同人,影视同人,网游动漫,网游小说,同人小说,游戏竞技',
	'66'=>'科幻,灵异,古武机甲,末日幻想,星际冒险,未来世界,变异进化,星际战争,数字生命,超级科技,时空穿梭,进化变异,末世危机,恐怖灵异,探险惊魂,悬疑推理,鬼怪志异,灵异奇谈,恐怖惊悚,推理侦探,悬疑探险,侦探推理,科幻小说,恐怖小说,灵异小说,恐怖悬疑,军事科幻',
);
//完结标识
$abover_Array=array('完结','完本','全本','写完','完成');
?>