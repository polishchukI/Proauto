@extends('shop.template')

@section('content')
<!-- site__body -->
<div class="site__body">
	<div class="block-header block-header--has-breadcrumb block-header--has-title">
		<div class="container">
			<div class="block-header__body">
				<!--breadcrumbs-->
				@include('shop.layouts.breadcrumbs')
				<!--breadcrumbs-end-->
				<h1 class="block-header__title">Oils</h1>
			</div>
		</div>
	</div>
	<div class="block-split block-split--has-sidebar">
		<div class="container">
		<div class="catalog-oil__params">
            <div class="catalog-oil__handle-mobile x-handle-mobile"></div>
            <div class="catalog-oil__params-title x-catalog-params-title">Поиск масел по параметрам</div>
            <div action="" method="get" name="filter_search_form" id="searcho" class="catalog-oil__params-wrapper x-catalog-params">

                <div class="catalog-oil__params-block ">
                    <label for="select_genesis" class="catalog-oil__params-label">Тип жидкости</label>
                    <select id="select_genesis" class="ui-select catalog-oil__params-select x-genesis-select" name="genesis_id" data-par="genesis">
                        <option value="-1">Выбрать</option>
                                                <option value="0" data-alias="motornoe-maslo">Моторное масло</option>
                        
                        <option value="1" data-alias="transmissionnoe-maslo">Трансмиссионное масло</option>
                        
                        <option value="2" data-alias="reduktornoe-maslo">Редукторное масло</option>
                        
                        <option value="3" data-alias="gidravlicheskoe-maslo">Гидравлическое масло</option>
                        
                        <option value="4" data-alias="gidravlicheskaya-zhidkost">Гидравлическая жидкость</option>
                        
                        <option value="5" data-alias="ohlazhdayushchaya-zhidkost">Охлаждающая жидкость</option>
                        
                        <option value="6" data-alias="tormoznay-zhidkost">Тормозная жидкость</option>
                        
                        <option value="7" data-alias="zhidkost-omyvatelya">Жидкость омывателя</option>
                        
                        <option value="8" data-alias="germetik">Герметик</option>
                        
                        <option value="9" data-alias="smazka">Смазка</option>
                        
                    </select>
                </div>

                <div class="catalog-oil__params-block">
                    <label for="select_manuf" class="catalog-oil__params-label">Производитель</label>
                    <select id="select_manuf" class="ui-select catalog-oil__params-select x-catalog-oil-seo-params" name="manuf_id" data-par="manuf" data-filter="brand">
                        <option value="0">Выбрать</option>
                                                <option value="1" data-alias="3ton">3TON</option>
                        
                        <option value="252" data-alias="a-sport">A-Sport</option>
                        
                        <option value="3" data-alias="abro">Abro</option>
                        
                        <option value="4" data-alias="ac-delco">AC Delco</option>
                        
                        <option value="5" data-alias="addinol">Addinol</option>
                        
                        <option value="17002" data-alias="aga">AGA</option>
                        
                        <option value="17008" data-alias="agrol">Agrol</option>
                        
                        <option value="7" data-alias="aimol">Aimol</option>
                        
                        <option value="102" data-alias="aisin">Aisin</option>
                        
                        <option value="152" data-alias="ajusa">Ajusa</option>
                        
                        <option value="263" data-alias="akross">AKross</option>
                        
                        <option value="249" data-alias="alpine">Alpine</option>
                        
                        <option value="233" data-alias="amalie">Amalie</option>
                        
                        <option value="170" data-alias="amiwa">Amiwa</option>
                        
                        <option value="8" data-alias="amsoil">Amsoil</option>
                        
                        <option value="9" data-alias="aral">Aral</option>
                        
                        <option value="10" data-alias="arctic-cat">Arctic cat</option>
                        
                        <option value="230" data-alias="ardeca">Ardeca</option>
                        
                        <option value="17013" data-alias="areca">Areca</option>
                        
                        <option value="269" data-alias="areol">Areol</option>
                        
                        <option value="234" data-alias="arial">Arial</option>
                        
                        <option value="17014" data-alias="astron">Astron</option>
                        
                        <option value="114" data-alias="ate">Ate</option>
                        
                        <option value="231" data-alias="autobacs">Autobacs</option>
                        
                        <option value="11" data-alias="aveno">Aveno</option>
                        
                        <option value="17015" data-alias="avista">Avista</option>
                        
                        <option value="119" data-alias="awm">Awm</option>
                        
                        <option value="12" data-alias="bardahl">Bardahl</option>
                        
                        <option value="171" data-alias="behr-hella">Behr-hella</option>
                        
                        <option value="172" data-alias="beru">Beru</option>
                        
                        <option value="17016" data-alias="bizol">Bizol</option>
                        
                        <option value="13" data-alias="bmw">BMW</option>
                        
                        <option value="14" data-alias="bombardier">Bombardier</option>
                        
                        <option value="153" data-alias="bosal">Bosal</option>
                        
                        <option value="17009" data-alias="bosch">Bosch</option>
                        
                        <option value="15" data-alias="bp">BP</option>
                        
                        <option value="251" data-alias="bravoil">Bravoil</option>
                        
                        <option value="217" data-alias="cnrg">C.N.R.G</option>
                        
                        <option value="235" data-alias="cam2">Cam2</option>
                        
                        <option value="236" data-alias="carlson-oil">Carlson oil</option>
                        
                        <option value="197" data-alias="cartechnic">Cartechnic</option>
                        
                        <option value="16" data-alias="castrol">Castrol</option>
                        
                        <option value="198" data-alias="champion-oil">Champion oil</option>
                        
                        <option value="17003" data-alias="chemipro">Chemipro</option>
                        
                        <option value="253" data-alias="chempioil">Chempioil</option>
                        
                        <option value="17000" data-alias="chevron">Chevron</option>
                        
                        <option value="18" data-alias="chrysler">Chrysler</option>
                        
                        <option value="104" data-alias="citroenpeugeot">Citroen/peugeot</option>
                        
                        <option value="19" data-alias="comma">Comma</option>
                        
                        <option value="227" data-alias="cool-stream">Cool stream</option>
                        
                        <option value="154" data-alias="crc">Crc</option>
                        
                        <option value="20" data-alias="cupper">Cupper</option>
                        
                        <option value="17017" data-alias="cworks">Cworks</option>
                        
                        <option value="21" data-alias="datsun">Datsun</option>
                        
                        <option value="237" data-alias="delphi">Delphi</option>
                        
                        <option value="216" data-alias="detroil">Detroil</option>
                        
                        <option value="120" data-alias="diesel-technic">Diesel technic</option>
                        
                        <option value="199" data-alias="divinol">Divinol</option>
                        
                        <option value="155" data-alias="done-deal">Done deal</option>
                        
                        <option value="23" data-alias="elf">Elf</option>
                        
                        <option value="156" data-alias="elring">Elring</option>
                        
                        <option value="24" data-alias="eneos">Eneos</option>
                        
                        <option value="25" data-alias="eni">Eni</option>
                        
                        <option value="121" data-alias="esper">Esper</option>
                        
                        <option value="200" data-alias="eurol">Eurol</option>
                        
                        <option value="264" data-alias="eurorepar">EuroRepar</option>
                        
                        <option value="215" data-alias="everest">Everest</option>
                        
                        <option value="265" data-alias="extreme-lubricants">Extreme Lubricants</option>
                        
                        <option value="27" data-alias="fanfaro">Fanfaro</option>
                        
                        <option value="266" data-alias="favorit">Favorit</option>
                        
                        <option value="28" data-alias="febi">Febi</option>
                        
                        <option value="122" data-alias="felix">Felix</option>
                        
                        <option value="135" data-alias="ferodo">Ferodo</option>
                        
                        <option value="123" data-alias="fill-inn">Fill inn</option>
                        
                        <option value="225" data-alias="finke">Finke</option>
                        
                        <option value="124" data-alias="fleetquard">Fleetquard</option>
                        
                        <option value="29" data-alias="ford">Ford</option>
                        
                        <option value="136" data-alias="fte">Fte</option>
                        
                        <option value="30" data-alias="fuchs">Fuchs</option>
                        
                        <option value="173" data-alias="g-zox">G zox</option>
                        
                        <option value="32" data-alias="g-energy">G-Energy</option>
                        
                        <option value="195" data-alias="gazpromneft">Gazpromneft</option>
                        
                        <option value="31" data-alias="general-motors">General Motors</option>
                        
                        <option value="125" data-alias="glysantin">Glysantin</option>
                        
                        <option value="33" data-alias="gt-oil">GT oil</option>
                        
                        <option value="34" data-alias="gulf">Gulf</option>
                        
                        <option value="116" data-alias="gunk">Gunk</option>
                        
                        <option value="238" data-alias="hanako">Hanako</option>
                        
                        <option value="158" data-alias="hans-pries">Hans pries</option>
                        
                        <option value="137" data-alias="hella-pagid">Hella-pagid</option>
                        
                        <option value="126" data-alias="hepu">Hepu</option>
                        
                        <option value="146" data-alias="hi-gear">Hi-Gear</option>
                        
                        <option value="36" data-alias="honda">Honda</option>
                        
                        <option value="37" data-alias="hpx">Hpx</option>
                        
                        <option value="38" data-alias="hyundaikia">Hyundai / Kia</option>
                        
                        <option value="189" data-alias="xteer">Hyundai XTeer</option>
                        
                        <option value="127" data-alias="ice-tiger">Ice tiger</option>
                        
                        <option value="39" data-alias="idemitsu">Idemitsu</option>
                        
                        <option value="159" data-alias="img">Img</option>
                        
                        <option value="117" data-alias="jet-go">Jet go</option>
                        
                        <option value="138" data-alias="juridbendix">Jurid/bendix</option>
                        
                        <option value="175" data-alias="kamoka">Kamoka</option>
                        
                        <option value="176" data-alias="kangaroo">Kangaroo</option>
                        
                        <option value="204" data-alias="kendall">Kendall</option>
                        
                        <option value="196" data-alias="kixx">Kixx</option>
                        
                        <option value="239" data-alias="kroon-oil">Kroon oil</option>
                        
                        <option value="250" data-alias="kuttenkeuler">Kuttenkeuler</option>
                        
                        <option value="128" data-alias="kyk">Kyk</option>
                        
                        <option value="268" data-alias="lada">Lada</option>
                        
                        <option value="105" data-alias="land-rover">Land rover</option>
                        
                        <option value="147" data-alias="lavr-next">Lavr next</option>
                        
                        <option value="42" data-alias="liqui-moly">Liqui Moly</option>
                        
                        <option value="161" data-alias="loctite">Loctite</option>
                        
                        <option value="43" data-alias="lotos">Lotos</option>
                        
                        <option value="17012" data-alias="lubex">Lubex</option>
                        
                        <option value="270" data-alias="lucas-oil">Lucas Oil</option>
                        
                        <option value="177" data-alias="luk">Luk</option>
                        
                        <option value="44" data-alias="lukoil">Lukoil</option>
                        
                        <option value="45" data-alias="luxe">Luxe</option>
                        
                        <option value="205" data-alias="mag1">Mag1</option>
                        
                        <option value="46" data-alias="mannol">Mannol</option>
                        
                        <option value="47" data-alias="mazda">Mazda</option>
                        
                        <option value="48" data-alias="meguin">Meguin</option>
                        
                        <option value="49" data-alias="mercedes-benz">Mercedes Benz</option>
                        
                        <option value="106" data-alias="meyle">Meyle</option>
                        
                        <option value="107" data-alias="mg-rover">Mg rover</option>
                        
                        <option value="139" data-alias="mintex">Mintex</option>
                        
                        <option value="194" data-alias="mitasu">Mitasu</option>
                        
                        <option value="50" data-alias="mitsubishi">Mitsubishi</option>
                        
                        <option value="51" data-alias="mobil">Mobil</option>
                        
                        <option value="272" data-alias="mol">Mol</option>
                        
                        <option value="206" data-alias="moly-green">Moly green</option>
                        
                        <option value="52" data-alias="mopar">Mopar</option>
                        
                        <option value="162" data-alias="motip">Motip</option>
                        
                        <option value="53" data-alias="motorcraft">Motorcraft</option>
                        
                        <option value="54" data-alias="motorex">Motorex</option>
                        
                        <option value="278" data-alias="motrio">Motrio</option>
                        
                        <option value="56" data-alias="mpm-oil">Mpm oil</option>
                        
                        <option value="57" data-alias="neste">Neste</option>
                        
                        <option value="58" data-alias="ngn-oil">NGN oil</option>
                        
                        <option value="148" data-alias="nigrin">Nigrin</option>
                        
                        <option value="242" data-alias="niro">Niro</option>
                        
                        <option value="60" data-alias="nissan">Nissan</option>
                        
                        <option value="254" data-alias="novus">Novus</option>
                        
                        <option value="207" data-alias="oilright">Oilright</option>
                        
                        <option value="61" data-alias="opel">Opel</option>
                        
                        <option value="17007" data-alias="oregon">Oregon</option>
                        
                        <option value="267" data-alias="orlen-oil">Orlen Oil</option>
                        
                        <option value="255" data-alias="oscar">Oscar</option>
                        
                        <option value="129" data-alias="paraflu">Paraflu</option>
                        
                        <option value="245" data-alias="patron">Patron</option>
                        
                        <option value="109" data-alias="pe-automotive">Pe automotive</option>
                        
                        <option value="62" data-alias="pennasol">Pennasol</option>
                        
                        <option value="63" data-alias="pennzoil">Pennzoil</option>
                        
                        <option value="64" data-alias="pentosin">Pentosin</option>
                        
                        <option value="163" data-alias="permatex">Permatex</option>
                        
                        <option value="65" data-alias="petro-canada">Petro-Сanada</option>
                        
                        <option value="17005" data-alias="petronas-oleoblitz">Petronas OLEOBLITZ</option>
                        
                        <option value="17006" data-alias="petronas-paraflu">PETRONAS PARAFLU</option>
                        
                        <option value="83" data-alias="petronas-syntium">Petronas syntium</option>
                        
                        <option value="149" data-alias="pingo">Pingo</option>
                        
                        <option value="279" data-alias="polymerium">Polymerium</option>
                        
                        <option value="140" data-alias="porsche">Porsche</option>
                        
                        <option value="164" data-alias="presto">Presto</option>
                        
                        <option value="165" data-alias="prestone">Prestone</option>
                        
                        <option value="130" data-alias="pride">Pride</option>
                        
                        <option value="276" data-alias="prista">Prista</option>
                        
                        <option value="256" data-alias="professional-hundert">Professional hundert</option>
                        
                        <option value="67" data-alias="profix">Profix</option>
                        
                        <option value="68" data-alias="quakerstate">Quaker State</option>
                        
                        <option value="178" data-alias="quick-brake">Quick brake</option>
                        
                        <option value="69" data-alias="quicksilver">Quicksilver</option>
                        
                        <option value="70" data-alias="ravenol">Ravenol</option>
                        
                        <option value="71" data-alias="red-line-oil">Red line oil</option>
                        
                        <option value="166" data-alias="reinz">Reinz</option>
                        
                        <option value="257" data-alias="rektol">Rektol</option>
                        
                        <option value="131" data-alias="renault">Renault</option>
                        
                        <option value="210" data-alias="repsol">Repsol</option>
                        
                        <option value="244" data-alias="rheinol">Rheinol</option>
                        
                        <option value="258" data-alias="rinkai">Rinkai</option>
                        
                        <option value="17001" data-alias="rixx">Rixx</option>
                        
                        <option value="192" data-alias="rolf">Rolf</option>
                        
                        <option value="223" data-alias="rosdot">Rosdot</option>
                        
                        <option value="72" data-alias="rowe">Rowe</option>
                        
                        <option value="275" data-alias="rymax">Rymax</option>
                        
                        <option value="76" data-alias="s-oil">S-oil</option>
                        
                        <option value="179" data-alias="sachs">Sachs</option>
                        
                        <option value="224" data-alias="sakura">Sakura</option>
                        
                        <option value="246" data-alias="samurai-gt">Samurai GT</option>
                        
                        <option value="141" data-alias="seiken">Seiken</option>
                        
                        <option value="74" data-alias="selenia">Selenia</option>
                        
                        <option value="75" data-alias="shell">Shell</option>
                        
                        <option value="240" data-alias="sintec">Sintec</option>
                        
                        <option value="180" data-alias="skf">Skf</option>
                        
                        <option value="111" data-alias="smart">Smart</option>
                        
                        <option value="181" data-alias="soft99">Soft99</option>
                        
                        <option value="150" data-alias="sonax">Sonax</option>
                        
                        <option value="17004" data-alias="sprinta">Sprinta</option>
                        
                        <option value="212" data-alias="srs">Srs</option>
                        
                        <option value="77" data-alias="ssang-yong">SsangYong</option>
                        
                        <option value="259" data-alias="starkraft">Starkraft</option>
                        
                        <option value="78" data-alias="statoil">Statoil</option>
                        
                        <option value="79" data-alias="stihl">Stihl</option>
                        
                        <option value="80" data-alias="subaru">Subaru</option>
                        
                        <option value="201" data-alias="sumico--alphas">Sumico / Alphas</option>
                        
                        <option value="167" data-alias="superhelp">Superhelp</option>
                        
                        <option value="182" data-alias="suprotec">Suprotec</option>
                        
                        <option value="81" data-alias="suzuki">Suzuki</option>
                        
                        <option value="82" data-alias="swag">SWAG</option>
                        
                        <option value="243" data-alias="swd">Swd</option>
                        
                        <option value="183" data-alias="swd-rheinol">Swd rheinol</option>
                        
                        <option value="241" data-alias="takayama">Takayama</option>
                        
                        <option value="273" data-alias="tatneft">Tatneft</option>
                        
                        <option value="132" data-alias="tcl">Tcl</option>
                        
                        <option value="84" data-alias="teboil">Teboil</option>
                        
                        <option value="168" data-alias="teroson">Teroson</option>
                        
                        <option value="85" data-alias="texaco">Texaco</option>
                        
                        <option value="262" data-alias="texoil">Texoil</option>
                        
                        <option value="142" data-alias="textar">Textar</option>
                        
                        <option value="133" data-alias="topran">Topran</option>
                        
                        <option value="86" data-alias="totachi">Totachi</option>
                        
                        <option value="87" data-alias="total">Total</option>
                        
                        <option value="88" data-alias="toyota">Toyota</option>
                        
                        <option value="143" data-alias="trw">Trw</option>
                        
                        <option value="169" data-alias="tunap">Tunap</option>
                        
                        <option value="112" data-alias="tutela">Tutela</option>
                        
                        <option value="193" data-alias="uaz">Uaz</option>
                        
                        <option value="211" data-alias="unil">Unil</option>
                        
                        <option value="228" data-alias="united">United</option>
                        
                        <option value="89" data-alias="urania">Urania</option>
                        
                        <option value="91" data-alias="vag">VAG</option>
                        
                        <option value="92" data-alias="vaico">Vaico</option>
                        
                        <option value="134" data-alias="valeo">Valeo</option>
                        
                        <option value="93" data-alias="valvoline">Valvoline</option>
                        
                        <option value="94" data-alias="vapsoil">Vapsoil</option>
                        
                        <option value="260" data-alias="verity">Verity</option>
                        
                        <option value="17010" data-alias="vitex">Vitex</option>
                        
                        <option value="184" data-alias="vmpauto">Vmpauto</option>
                        
                        <option value="95" data-alias="volvo">Volvo</option>
                        
                        <option value="96" data-alias="vs">Vs</option>
                        
                        <option value="185" data-alias="wd-40">Wd-40</option>
                        
                        <option value="229" data-alias="wego">Wego</option>
                        
                        <option value="151" data-alias="wynn-s">Wynn s</option>
                        
                        <option value="219" data-alias="x-freeze">X-freeze</option>
                        
                        <option value="98" data-alias="xado">Xado</option>
                        
                        <option value="188" data-alias="xenum">Xenum</option>
                        
                        <option value="214" data-alias="yacco">Yacco</option>
                        
                        <option value="99" data-alias="yamaha">YamaLube</option>
                        
                        <option value="100" data-alias="yokki">Yokki</option>
                        
                        <option value="113" data-alias="zf-parts">Zf parts</option>
                        
                        <option value="101" data-alias="zic">ZIC</option>
                        
                        <option value="17018" data-alias="bars">Барс</option>
                        
                        <option value="218" data-alias="volga-oil">Волга-ойл</option>
                        
                        <option value="17011" data-alias="devon">Девон</option>
                        
                        <option value="220" data-alias="neva-m">Нева-м</option>
                        
                        <option value="17019" data-alias="polyarnik">Полярник</option>
                        
                        <option value="221" data-alias="rosa">Роса</option>
                        
                        <option value="186" data-alias="rosneft">Роснефть</option>
                        
                        <option value="187" data-alias="tnk">Тнк</option>
                        
                        <option value="222" data-alias="tom">Томь</option>
                        
                    </select>
                </div>

                <div class="catalog-oil__params-block">
                    <label for="select_toughnes" class="catalog-oil__params-label">Вязкость по SAE</label>
                    <select id="select_toughnes" class="ui-select catalog-oil__params-select x-catalog-oil-seo-params" name="toughnes_id" data-par="toughnes" data-filter="vyazkost">
                        <option value="-1">Выбрать</option>
                                                <option value="6" data-alias="0w-8">0W-8</option>
                        
                        <option value="7" data-alias="0w-12">0W-12</option>
                        
                        <option value="0" data-alias="0w-15">0W-15</option>
                        
                        <option value="1" data-alias="0w-16">0W-16</option>
                        
                        <option value="2" data-alias="0w-20">0W-20</option>
                        
                        <option value="3" data-alias="0w-30">0W-30</option>
                        
                        <option value="4" data-alias="0w-40">0W-40</option>
                        
                        <option value="5" data-alias="0w-50">0W-50</option>
                        
                        <option value="8" data-alias="0w-10">0W-10</option>
                        
                        <option value="9" data-alias="0w-5">0W-5</option>
                        
                        <option value="19" data-alias="5w-16">5W-16</option>
                        
                        <option value="20" data-alias="5w-20">5W-20</option>
                        
                        <option value="21" data-alias="5w-30">5W-30</option>
                        
                        <option value="22" data-alias="5w-40">5W-40</option>
                        
                        <option value="23" data-alias="5w-50">5W-50</option>
                        
                        <option value="24" data-alias="7.5w-40">7.5W-40</option>
                        
                        <option value="30" data-alias="10w-30">10W-30</option>
                        
                        <option value="31" data-alias="10w-40">10W-40</option>
                        
                        <option value="32" data-alias="10w-50">10W-50</option>
                        
                        <option value="33" data-alias="10w-60">10W-60</option>
                        
                        <option value="39" data-alias="15w-30">15W-30</option>
                        
                        <option value="40" data-alias="15w-40">15W-40</option>
                        
                        <option value="41" data-alias="15w-50">15W-50</option>
                        
                        <option value="42" data-alias="15w-60">15W-60</option>
                        
                        <option value="50" data-alias="20w-20">20W-20</option>
                        
                        <option value="51" data-alias="20w-40">20W-40</option>
                        
                        <option value="52" data-alias="20w-50">20W-50</option>
                        
                        <option value="53" data-alias="20w-60">20W-60</option>
                        
                        <option value="54" data-alias="20w-30">20W-30</option>
                        
                        <option value="60" data-alias="25w-40">25W-40</option>
                        
                        <option value="61" data-alias="25w-50">25W-50</option>
                        
                        <option value="62" data-alias="25w-60">25W-60</option>
                        
                        <option value="70" data-alias="70w-80">70W-80</option>
                        
                        <option value="71" data-alias="75w-80">75W-80</option>
                        
                        <option value="72" data-alias="75w-85">75W-85</option>
                        
                        <option value="73" data-alias="75w-90">75W-90</option>
                        
                        <option value="74" data-alias="75w-110">75W-110</option>
                        
                        <option value="75" data-alias="75w-140">75W-140</option>
                        
                        <option value="76" data-alias="75w-250">75W-250</option>
                        
                        <option value="77" data-alias="70w-75w">70W-75W</option>
                        
                        <option value="80" data-alias="80w-85">80W-85</option>
                        
                        <option value="81" data-alias="80w-90">80W-90</option>
                        
                        <option value="82" data-alias="80w-140">80W-140</option>
                        
                        <option value="83" data-alias="80w-250">80W-250</option>
                        
                        <option value="90" data-alias="85w-90">85W-90</option>
                        
                        <option value="91" data-alias="85w-140">85W-140</option>
                        
                        <option value="92" data-alias="85w-80">85W-80</option>
                        
                        <option value="101" data-alias="sae 20">SAE 20</option>
                        
                        <option value="102" data-alias="sae 30">SAE 30</option>
                        
                        <option value="103" data-alias="sae 40">SAE 40</option>
                        
                        <option value="104" data-alias="sae 50">SAE 50</option>
                        
                        <option value="105" data-alias="sae 60">SAE 60</option>
                        
                        <option value="112" data-alias="40w">40W</option>
                        
                        <option value="107" data-alias="sae 80">SAE 80</option>
                        
                        <option value="108" data-alias="sae 90">SAE 90</option>
                        
                        <option value="111" data-alias="sae 140">SAE 140</option>
                        
                        <option value="106" data-alias="10w">10W</option>
                        
                        <option value="109" data-alias="75w">75W</option>
                        
                        <option value="110" data-alias="90w">90W</option>
                        
                    </select>
                </div>

                <div class="catalog-oil__params-block">
                    <label for="select_structure" class="catalog-oil__params-label">Состав</label>
                    <select id="select_structure" class="ui-select catalog-oil__params-select x-catalog-oil-seo-params" name="structure_id" data-par="structure" data-filter="struktura">
                        <option value="-1">Выбрать</option>
                                                <option value="0" data-alias="sintetika">Синтетическое</option>
                        
                        <option value="1" data-alias="polusintetika">Полусинтетическое</option>
                        
                        <option value="2" data-alias="mineralnoe">Минеральное</option>
                        
                    </select>
                </div>

                <div class="catalog-oil__params-block">
                    <label for="select_specific3" class="catalog-oil__params-label">Спецификация ACEA</label>
                    <select id="select_specific3" class="ui-select catalog-oil__params-select" name="specific3_id" data-par="specific3">
                        <option value="0">Выбрать</option>
                                                <option value="833">A1</option>
                        
                        <option value="842">A2</option>
                        
                        <option value="827">A3</option>
                        
                        <option value="878">A3/B3</option>
                        
                        <option value="879">A3/B4</option>
                        
                        <option value="844">A4</option>
                        
                        <option value="830">A5</option>
                        
                        <option value="880">A5/B5</option>
                        
                        <option value="832">B1</option>
                        
                        <option value="840">B2</option>
                        
                        <option value="826">B3</option>
                        
                        <option value="828">B4</option>
                        
                        <option value="831">B5</option>
                        
                        <option value="836">C1</option>
                        
                        <option value="834">C2</option>
                        
                        <option value="829">C3</option>
                        
                        <option value="835">C4</option>
                        
                        <option value="886">C5</option>
                        
                        <option value="841">E2</option>
                        
                        <option value="824">E3</option>
                        
                        <option value="839">E4</option>
                        
                        <option value="825">E5</option>
                        
                        <option value="843">E6</option>
                        
                        <option value="837">E7</option>
                        
                        <option value="838">E9</option>
                        
                    </select>
                </div>

                <div class="catalog-oil__params-block">
                    <label for="select_specific2" class="catalog-oil__params-label">Спецификация API</label>
                    <select id="select_specific2" class="ui-select catalog-oil__params-select" name="specific2_id" data-par="specific2">
                        <option value="0">Выбрать</option>
                                                <option value="807">CB</option>
                        
                        <option value="792">CC</option>
                        
                        <option value="786">CD</option>
                        
                        <option value="812">CE</option>
                        
                        <option value="783">CF</option>
                        
                        <option value="796">CF-2</option>
                        
                        <option value="805">CF-3</option>
                        
                        <option value="800">CF-4</option>
                        
                        <option value="799">CG-4</option>
                        
                        <option value="788">CH-4</option>
                        
                        <option value="789">CI-4</option>
                        
                        <option value="797">CI-4+</option>
                        
                        <option value="798">CJ-4</option>
                        
                        <option value="889">CK-4</option>
                        
                        <option value="888">CK-4</option>
                        
                        <option value="806">CP</option>
                        
                        <option value="801">EC</option>
                        
                        <option value="820">GL 3+</option>
                        
                        <option value="816">GL-1</option>
                        
                        <option value="817">GL-2</option>
                        
                        <option value="818">GL-3</option>
                        
                        <option value="811">GL-4</option>
                        
                        <option value="814">GL-4+</option>
                        
                        <option value="813">GL-5</option>
                        
                        <option value="822">GL-5+</option>
                        
                        <option value="821">GL-6</option>
                        
                        <option value="819">LS</option>
                        
                        <option value="815">MT-1</option>
                        
                        <option value="803">RC</option>
                        
                        <option value="876">SA</option>
                        
                        <option value="875">SB</option>
                        
                        <option value="808">SD</option>
                        
                        <option value="802">SE</option>
                        
                        <option value="793">SF</option>
                        
                        <option value="787">SG</option>
                        
                        <option value="795">SH</option>
                        
                        <option value="784">SJ</option>
                        
                        <option value="794">SL</option>
                        
                        <option value="791">SM</option>
                        
                        <option value="790">SN</option>
                        
                        <option value="890">SN+</option>
                        
                        <option value="804">TC</option>
                        
                        <option value="809">TC+</option>
                        
                        <option value="810">TD</option>
                        
                    </select>
                </div>

                <div class="catalog-oil__params-block">
                    <label for="select_specific1" class="catalog-oil__params-label">Спецификация OEM</label>
                    <select id="select_specific1" class="ui-select catalog-oil__params-select" name="specific1_id" data-par="specific1">
                        <option value="0">Выбрать</option>
                                                <option value="409"></option>
                        
                        <option value="887">236.17</option>
                        
                        <option value="593">AcDelco 10-4032</option>
                        
                        <option value="194">Acura HTO-06</option>
                        
                        <option value="743">AFNOR NFR 15-601</option>
                        
                        <option value="752">AFNOR R-15-501</option>
                        
                        <option value="345">Aisin AW JWS 3309</option>
                        
                        <option value="442">Aisin Warner</option>
                        
                        <option value="322">Allison C3</option>
                        
                        <option value="218">Allison C4</option>
                        
                        <option value="454">Allison TES 295</option>
                        
                        <option value="310">Allison TES 389</option>
                        
                        <option value="780">Arvin Meritor Transmission 076-N</option>
                        
                        <option value="595">ATF 134 FE</option>
                        
                        <option value="596">ATF 134 ME</option>
                        
                        <option value="608">ATF 3292</option>
                        
                        <option value="597">ATF 7134 FE</option>
                        
                        <option value="519">ATF DCG-II</option>
                        
                        <option value="587">ATF L 12108</option>
                        
                        <option value="420">Audi 6 speed FWD</option>
                        
                        <option value="496">Audi TL 52180</option>
                        
                        <option value="672">Bentley</option>
                        
                        <option value="361">BMW</option>
                        
                        <option value="499">BMW 1375.4</option>
                        
                        <option value="642">BMW 7045 E</option>
                        
                        <option value="676">BMW 8122 9 407 758</option>
                        
                        <option value="661">BMW 8122 9 407 858</option>
                        
                        <option value="662">BMW 8122 9 407 859</option>
                        
                        <option value="566">BMW 8322 0 136 376</option>
                        
                        <option value="437">BMW 8322 0 142 516</option>
                        
                        <option value="488">BMW 8322 0 144 137</option>
                        
                        <option value="569">BMW 8322 0 309 031</option>
                        
                        <option value="656">BMW 8322 0 397 114</option>
                        
                        <option value="415">BMW 8322 0 429 154</option>
                        
                        <option value="567">BMW 8322 0 429 159</option>
                        
                        <option value="243">BMW 8322 0 440 214</option>
                        
                        <option value="244">BMW 8322 2 147 477</option>
                        
                        <option value="245">BMW 8322 2 148 578</option>
                        
                        <option value="246">BMW 8322 2 148 579</option>
                        
                        <option value="663">BMW 8322 2 152 426</option>
                        
                        <option value="477">BMW 8322 2 152 426 ATF L 12108</option>
                        
                        <option value="667">BMW 8322 2 167 720</option>
                        
                        <option value="483">BMW 8322 9 407 807</option>
                        
                        <option value="382">BMW DCTF-1</option>
                        
                        <option value="421">BMW Drivelogic 7 speed</option>
                        
                        <option value="540">BMW ETL-7045E</option>
                        
                        <option value="686">BMW GS 9400</option>
                        
                        <option value="181">BMW High Performance Diesel Oil</option>
                        
                        <option value="284">BMW LA 2634</option>
                        
                        <option value="117">BMW Longlife- 01 FE</option>
                        
                        <option value="18">BMW Longlife-01</option>
                        
                        <option value="11">BMW Longlife-04</option>
                        
                        <option value="104">BMW Longlife-98</option>
                        
                        <option value="285">BMW LT 71141</option>
                        
                        <option value="737">BMW Mini Cooper D 2007</option>
                        
                        <option value="503">BMW MTF LT-1</option>
                        
                        <option value="504">BMW MTF LT-2</option>
                        
                        <option value="505">BMW MTF LT-3</option>
                        
                        <option value="506">BMW MTF LT-4</option>
                        
                        <option value="707">BMW N 600 69.0</option>
                        
                        <option value="712">BMW N 600 6910</option>
                        
                        <option value="731">BMW N60069.0</option>
                        
                        <option value="150">BMW Spezial</option>
                        
                        <option value="198">Bombardier</option>
                        
                        <option value="684">BS 5117</option>
                        
                        <option value="685">BS 6580</option>
                        
                        <option value="704">BS6580-1992</option>
                        
                        <option value="609">Caltex 1712</option>
                        
                        <option value="771">Case JIC 501</option>
                        
                        <option value="727">Case MS1710</option>
                        
                        <option value="696">Caterpillar EC-1</option>
                        
                        <option value="49">Caterpillar ECF-1</option>
                        
                        <option value="2">Caterpillar ECF-1a</option>
                        
                        <option value="3">Caterpillar ECF-2</option>
                        
                        <option value="4">Caterpillar ECF-3</option>
                        
                        <option value="303">Caterpillar TO-2</option>
                        
                        <option value="367">Caterpillar TO-4</option>
                        
                        <option value="675">CHF 11 S</option>
                        
                        <option value="473">Chrysler ATF +3</option>
                        
                        <option value="286">Chrysler ATF +4</option>
                        
                        <option value="474">Chrysler ATF 4</option>
                        
                        <option value="765">Chrysler DBL-7700</option>
                        
                        <option value="193">Chrysler MS 10725</option>
                        
                        <option value="46">Chrysler MS 10850</option>
                        
                        <option value="66">Chrysler MS 10902</option>
                        
                        <option value="179">Chrysler MS 11106</option>
                        
                        <option value="38">Chrysler MS 6395</option>
                        
                        <option value="126">Chrysler MS 6395-N</option>
                        
                        <option value="195">Chrysler MS 6395-Q</option>
                        
                        <option value="196">Chrysler MS 6395-R</option>
                        
                        <option value="197">Chrysler MS 6395-S</option>
                        
                        <option value="635">Chrysler MS-10216</option>
                        
                        <option value="256">Chrysler MS-5644</option>
                        
                        <option value="570">Chrysler MS-5931</option>
                        
                        <option value="697">Chrysler MS-7170</option>
                        
                        <option value="633">Chrysler MS-8985</option>
                        
                        <option value="297">Chrysler MS-9070</option>
                        
                        <option value="294">Chrysler MS-9224</option>
                        
                        <option value="295">Chrysler MS-9417</option>
                        
                        <option value="631">Chrysler MS-9602</option>
                        
                        <option value="611">Chrysler MS-9763</option>
                        
                        <option value="698">Chrysler MS-9769</option>
                        
                        <option value="422">Chrysler Powershift 6 speed</option>
                        
                        <option value="541">Citroen ATF LT 71141</option>
                        
                        <option value="423">Citroen DCS 6 speed</option>
                        
                        <option value="622">CNH MAT 3505</option>
                        
                        <option value="623">CNH MAT 3509</option>
                        
                        <option value="624">CNH MAT 3525</option>
                        
                        <option value="687">Cummins 85T8-2</option>
                        
                        <option value="719">Cummins 90T8-4</option>
                        
                        <option value="699">Cummins CES 14603</option>
                        
                        <option value="50">Cummins CES 20071</option>
                        
                        <option value="51">Cummins CES 20072</option>
                        
                        <option value="52">Cummins CES 20076</option>
                        
                        <option value="53">Cummins CES 20077</option>
                        
                        <option value="105">Cummins CES 20078</option>
                        
                        <option value="67">Cummins CES 20081</option>
                        
                        <option value="753">CUNA NC 956-16</option>
                        
                        <option value="124">DAF</option>
                        
                        <option value="772">DAF 74002</option>
                        
                        <option value="86">DAF HP1</option>
                        
                        <option value="87">DAF HP2</option>
                        
                        <option value="268">DAIHATSU CVT Fluid DC</option>
                        
                        <option value="279">DANA SHAES-234</option>
                        
                        <option value="280">DANA SHAES-256</option>
                        
                        <option value="281">DANA SHAES-429 A</option>
                        
                        <option value="175">DDC 7SE270</option>
                        
                        <option value="54">DDC 93K214</option>
                        
                        <option value="171">DDC 93K215</option>
                        
                        <option value="68">DDC 93K218</option>
                        
                        <option value="429">Denison HF-0</option>
                        
                        <option value="700">Detroit Diesel 93k217</option>
                        
                        <option value="776">Detroit Diesel Corp</option>
                        
                        <option value="143">Deutz DQC II-05</option>
                        
                        <option value="145">Deutz DQC II-10</option>
                        
                        <option value="141">Deutz DQC III-05</option>
                        
                        <option value="94">Deutz DQC III-10</option>
                        
                        <option value="224">Deutz DQC III-10 LA</option>
                        
                        <option value="153">Deutz DQC IV-05</option>
                        
                        <option value="109">Deutz DQC IV-10</option>
                        
                        <option value="713">Deutz TR 0119-399-1115</option>
                        
                        <option value="373">DEX-CVT</option>
                        
                        <option value="520">Dia-Queen SSTF-I</option>
                        
                        <option value="393">Eaton PS-164 rev 7</option>
                        
                        <option value="720">Federal Specification A-A-870</option>
                        
                        <option value="763">Fiat 9.55523</option>
                        
                        <option value="206">FIAT 9.55535-CR1</option>
                        
                        <option value="114">FIAT 9.55535-D2</option>
                        
                        <option value="116">FIAT 9.55535-G1</option>
                        
                        <option value="151">FIAT 9.55535-G2</option>
                        
                        <option value="207">FIAT 9.55535-GH2</option>
                        
                        <option value="205">FIAT 9.55535-GS1</option>
                        
                        <option value="137">FIAT 9.55535-H2</option>
                        
                        <option value="144">FIAT 9.55535-H3</option>
                        
                        <option value="138">FIAT 9.55535-M2</option>
                        
                        <option value="188">FIAT 9.55535-N</option>
                        
                        <option value="139">FIAT 9.55535-N2</option>
                        
                        <option value="123">FIAT 9.55535-S1</option>
                        
                        <option value="43">FIAT 9.55535-S2</option>
                        
                        <option value="140">FIAT 9.55535-Z2</option>
                        
                        <option value="630">FIAT 9.55550</option>
                        
                        <option value="632">FIAT 9.55550-AV4</option>
                        
                        <option value="637">FIAT 9.55550-AV5</option>
                        
                        <option value="634">FIAT 9.55550-DA5</option>
                        
                        <option value="629">FIAT 9.55550-MZ6</option>
                        
                        <option value="184">FMK</option>
                        
                        <option value="444">Ford CVT23</option>
                        
                        <option value="445">Ford CVT30</option>
                        
                        <option value="304">Ford EPS-M2C 138-CJ</option>
                        
                        <option value="287">Ford EPS-M2C 166-H</option>
                        
                        <option value="230">Ford ESD-M2C 175-A</option>
                        
                        <option value="762">Ford ESD-M97 B49-A</option>
                        
                        <option value="744">Ford ESE-M978B4H-A</option>
                        
                        <option value="721">Ford ESE-M97B44-A</option>
                        
                        <option value="717">Ford ESE-M97B44-D</option>
                        
                        <option value="257">Ford ESP-M2C 154-A</option>
                        
                        <option value="497">Ford ESP-M2C 166-H</option>
                        
                        <option value="387">Ford ESP-M2C 33-F</option>
                        
                        <option value="388">Ford ESP-M2C 33-G</option>
                        
                        <option value="258">Ford ESW-M2C 105-A</option>
                        
                        <option value="173">Ford FOCUS RS</option>
                        
                        <option value="461">Ford M2C 134-A</option>
                        
                        <option value="462">Ford M2C 134-B</option>
                        
                        <option value="463">Ford M2C 134-C</option>
                        
                        <option value="213">Ford M2C 134-D</option>
                        
                        <option value="323">Ford M2C 138-CJ</option>
                        
                        <option value="223">Ford M2C 153-E</option>
                        
                        <option value="214">Ford M2C 159-B</option>
                        
                        <option value="215">Ford M2C 159-C</option>
                        
                        <option value="216">Ford M2C 159-D</option>
                        
                        <option value="528">Ford M2C 163-A</option>
                        
                        <option value="324">Ford M2C 166-H</option>
                        
                        <option value="583">Ford M2C 175</option>
                        
                        <option value="325">Ford M2C 185-A</option>
                        
                        <option value="580">Ford M2C 33-F</option>
                        
                        <option value="581">Ford M2C 33-G</option>
                        
                        <option value="464">Ford M2C 41-B</option>
                        
                        <option value="465">Ford M2C 48-B</option>
                        
                        <option value="466">Ford M2C 53-A</option>
                        
                        <option value="467">Ford M2C 86-B</option>
                        
                        <option value="585">Ford M2C 9002-A</option>
                        
                        <option value="210">Ford M2C 925-B</option>
                        
                        <option value="374">Ford M2C 928-A</option>
                        
                        <option value="225">Ford Mercon</option>
                        
                        <option value="438">Ford Mercon LV</option>
                        
                        <option value="500">Ford MERCON SP</option>
                        
                        <option value="390">Ford Mercon V</option>
                        
                        <option value="424">FORD Powershift 6 speed</option>
                        
                        <option value="259">Ford SQM-2C 9001-A</option>
                        
                        <option value="260">Ford SQM-2C 9002- A</option>
                        
                        <option value="330">Ford SQM-2C 9002-AA</option>
                        
                        <option value="261">Ford SQM-2C 9008-A</option>
                        
                        <option value="364">Ford SQM-2C 9010-A</option>
                        
                        <option value="326">Ford SQM-2C 9010-B</option>
                        
                        <option value="641">Ford WSD-M2C 200-C</option>
                        
                        <option value="241">Ford WSL-M2C 192-A</option>
                        
                        <option value="107">Ford WSS-M2C 153-H</option>
                        
                        <option value="69">Ford WSS-M2C 171-E</option>
                        
                        <option value="5">Ford WSS-M2C 1717-E</option>
                        
                        <option value="542">Ford WSS-M2C 200-B</option>
                        
                        <option value="405">Ford WSS-M2C 200-C</option>
                        
                        <option value="353">Ford WSS-M2C 200-D2</option>
                        
                        <option value="578">Ford WSS-M2C 202-B</option>
                        
                        <option value="547">Ford WSS-M2C 204-A</option>
                        
                        <option value="64">Ford WSS-M2C 205-A</option>
                        
                        <option value="159">Ford WSS-M2C 912-A1</option>
                        
                        <option value="25">Ford WSS-M2C 913-A</option>
                        
                        <option value="26">Ford WSS-M2C 913-B</option>
                        
                        <option value="42">Ford WSS-M2C 913-C</option>
                        
                        <option value="118">Ford WSS-M2C 913-D</option>
                        
                        <option value="47">Ford WSS-M2C 917-A</option>
                        
                        <option value="178">Ford WSS-M2C 920-A</option>
                        
                        <option value="384">Ford WSS-M2C 924-A</option>
                        
                        <option value="39">Ford WSS-M2C 925-A</option>
                        
                        <option value="108">Ford WSS-M2C 925-B</option>
                        
                        <option value="416">Ford WSS-M2C 928-A</option>
                        
                        <option value="61">Ford WSS-M2C 929-A</option>
                        
                        <option value="40">Ford WSS-M2C 930-A</option>
                        
                        <option value="48">Ford WSS-M2C 930-B</option>
                        
                        <option value="204">Ford WSS-M2C 931-B</option>
                        
                        <option value="535">Ford WSS-M2C 933-A</option>
                        
                        <option value="200">Ford WSS-M2C 934-A</option>
                        
                        <option value="44">Ford WSS-M2C 934-B</option>
                        
                        <option value="201">Ford WSS-M2C 934-C</option>
                        
                        <option value="475">Ford WSS-M2C 936</option>
                        
                        <option value="360">Ford WSS-M2C 936-A</option>
                        
                        <option value="115">Ford WSS-M2C 937-A</option>
                        
                        <option value="536">Ford WSS-M2C 938-A</option>
                        
                        <option value="41">Ford WSS-M2C 945-A</option>
                        
                        <option value="168">Ford WSS-M2C 945-B</option>
                        
                        <option value="62">Ford WSS-M2C 946-A</option>
                        
                        <option value="78">Ford WSS-M2C 947-A</option>
                        
                        <option value="99">Ford WSS-M2C 948-B</option>
                        
                        <option value="701">Ford WSS-M97B44-D</option>
                        
                        <option value="702">Ford WSS-M97B51-A</option>
                        
                        <option value="728">Ford WSS-M97B51-A1</option>
                        
                        <option value="766">Ford WSS-M97B55</option>
                        
                        <option value="403">G 34088</option>
                        
                        <option value="70">Global DHD-1</option>
                        
                        <option value="722">GM 1825M</option>
                        
                        <option value="723">GM 1899M</option>
                        
                        <option value="375">GM 1940713</option>
                        
                        <option value="376">GM 1940714</option>
                        
                        <option value="155">GM 4118M</option>
                        
                        <option value="63">GM 4718M</option>
                        
                        <option value="724">GM 6038M</option>
                        
                        <option value="174">GM 6085M</option>
                        
                        <option value="10">GM 6094M</option>
                        
                        <option value="404">GM 613714</option>
                        
                        <option value="718">GM 6277M</option>
                        
                        <option value="639">GM 6417M</option>
                        
                        <option value="296">GM 9985648</option>
                        
                        <option value="529">GM 9986195</option>
                        
                        <option value="732">GM B 040 0240</option>
                        
                        <option value="262">GM B 0401010</option>
                        
                        <option value="584">GM B 040104</option>
                        
                        <option value="65">GM Dexos 1</option>
                        
                        <option value="37">GM Dexos 2</option>
                        
                        <option value="372">GM Dexron II</option>
                        
                        <option value="327">GM Dexron II D</option>
                        
                        <option value="305">GM Dexron II E</option>
                        
                        <option value="288">GM Dexron III</option>
                        
                        <option value="343">GM Dexron III D</option>
                        
                        <option value="498">GM Dexron III F</option>
                        
                        <option value="341">GM Dexron III G</option>
                        
                        <option value="344">GM Dexron III H</option>
                        
                        <option value="471">GM Dexron VI</option>
                        
                        <option value="564">GM GMN10060</option>
                        
                        <option value="668">GM N1006</option>
                        
                        <option value="688">GM QL130100</option>
                        
                        <option value="745">GM Saturn</option>
                        
                        <option value="19">GM-LL-A-025</option>
                        
                        <option value="15">GM-LL-B-025</option>
                        
                        <option value="191">GM-LL-B-026</option>
                        
                        <option value="128">HONDA</option>
                        
                        <option value="269">Honda ATF-Z1</option>
                        
                        <option value="446">Honda HMMF</option>
                        
                        <option value="679">Honda PSF-S</option>
                        
                        <option value="680">Honda PSF-V</option>
                        
                        <option value="681">Honda Ultra PSF-II</option>
                        
                        <option value="170">HUSQVARNA 242 Chainsaw Test</option>
                        
                        <option value="489">Hyundai 040000C90SG</option>
                        
                        <option value="651">Hyundai ATF Red-1K</option>
                        
                        <option value="289">Hyundai SP II</option>
                        
                        <option value="290">Hyundai SP III</option>
                        
                        <option value="439">HYUNDAI SP-IV</option>
                        
                        <option value="658">Hyundai SP-IVM</option>
                        
                        <option value="654">Hyundai SPH-IV</option>
                        
                        <option value="657">Hyundai SPH-IVRR</option>
                        
                        <option value="291">Idemitsu K17</option>
                        
                        <option value="394">International TMS 6816</option>
                        
                        <option value="455">Isuzu BESCO ATF-II</option>
                        
                        <option value="456">Isuzu BESCO ATF-IIl</option>
                        
                        <option value="142">IVECO</option>
                        
                        <option value="306">IVECO 18-1807 AG3</option>
                        
                        <option value="764">IVECO 18-1830</option>
                        
                        <option value="543">Jaguar ATF LT 71141</option>
                        
                        <option value="490">Jaguar C2C 8432</option>
                        
                        <option value="664">Jaguar Fluid 02JDE 26444</option>
                        
                        <option value="665">Jaguar Fluid 8432</option>
                        
                        <option value="484">Jaguar JLM 202 38</option>
                        
                        <option value="254">JASO 1-A</option>
                        
                        <option value="457">JASO 315M 1A</option>
                        
                        <option value="255">JASO M3151A</option>
                        
                        <option value="773">JASO M325</option>
                        
                        <option value="714">Jenbacher TA-NR1000- 0201</option>
                        
                        <option value="705">JIS K 2234</option>
                        
                        <option value="703">John Deere 8650-5</option>
                        
                        <option value="725">John Deere H24B1</option>
                        
                        <option value="726">John Deere H24C1</option>
                        
                        <option value="468">John Deere J20C</option>
                        
                        <option value="523">John Deere J27</option>
                        
                        <option value="729">John Deere JDM H24</option>
                        
                        <option value="652">Kia ATF Red-1K</option>
                        
                        <option value="653">Kia SP II</option>
                        
                        <option value="447">Kia SP III</option>
                        
                        <option value="669">Kia SPH-IV</option>
                        
                        <option value="502">Komatsu KES 07.868.1</option>
                        
                        <option value="190">LAND ROVER</option>
                        
                        <option value="120">Land Rover - ST JLR.03.5003</option>
                        
                        <option value="119">Land Rover - ST JLR.03.5004</option>
                        
                        <option value="122">Land Rover - ST JLR.51.5122</option>
                        
                        <option value="478">Land Rover LR023288</option>
                        
                        <option value="479">Land Rover LR023289</option>
                        
                        <option value="491">Land Rover TYK500050</option>
                        
                        <option value="544">Landrover ATF N 402</option>
                        
                        <option value="182">Lexus LFA Service Fill</option>
                        
                        <option value="689">Liebherr A 934 C HD Litronic</option>
                        
                        <option value="690">Liebherr A 934 C Litronic</option>
                        
                        <option value="733">Liebherr TLV 035</option>
                        
                        <option value="734">Liebherr TLV 23009A</option>
                        
                        <option value="186">M033MOT042</option>
                        
                        <option value="199">Mack EO L</option>
                        
                        <option value="133">Mack EO M</option>
                        
                        <option value="6">Mack EO M Plus</option>
                        
                        <option value="176">Mack EO M Premium Plus</option>
                        
                        <option value="113">Mack EO N</option>
                        
                        <option value="129">Mack EO N Plus</option>
                        
                        <option value="127">Mack EO N Premium Plus</option>
                        
                        <option value="71">Mack EO O</option>
                        
                        <option value="183">Mack EO O Plus</option>
                        
                        <option value="90">Mack EO O Premium Plus</option>
                        
                        <option value="157">MACK EO-K2</option>
                        
                        <option value="100">MACK EO-L</option>
                        
                        <option value="368">Mack GO-G</option>
                        
                        <option value="586">Mack GO-GGM</option>
                        
                        <option value="556">Mack GO-H</option>
                        
                        <option value="300">Mack GO-J</option>
                        
                        <option value="282">Mack GO-J Plus</option>
                        
                        <option value="557">Mack PG-1</option>
                        
                        <option value="558">Mack PG-2</option>
                        
                        <option value="366">MACK TO A Plus</option>
                        
                        <option value="160">MAN 270</option>
                        
                        <option value="55">MAN 271</option>
                        
                        <option value="730">MAN 324</option>
                        
                        <option value="708">MAN 324 Type NF</option>
                        
                        <option value="769">MAN 324 Type Si-OAT</option>
                        
                        <option value="691">MAN 324 Type SNF</option>
                        
                        <option value="166">MAN 3271-1</option>
                        
                        <option value="56">MAN 3275</option>
                        
                        <option value="95">MAN 3275-1</option>
                        
                        <option value="203">MAN 3277</option>
                        
                        <option value="431">MAN 3289</option>
                        
                        <option value="302">MAN 3343 Type M</option>
                        
                        <option value="342">MAN 3343 Type ML</option>
                        
                        <option value="619">MAN 3343 Type S</option>
                        
                        <option value="620">MAN 3343 Type SL</option>
                        
                        <option value="579">MAN 339 Type A</option>
                        
                        <option value="469">MAN 339 Type C</option>
                        
                        <option value="307">MAN 339 Type D</option>
                        
                        <option value="226">MAN 339 Type F</option>
                        
                        <option value="239">MAN 339 Type V1</option>
                        
                        <option value="354">MAN 339 Type V2</option>
                        
                        <option value="240">MAN 339 Type Z1</option>
                        
                        <option value="396">MAN 339 Type Z2</option>
                        
                        <option value="355">MAN 339 Type Z3</option>
                        
                        <option value="337">MAN 341</option>
                        
                        <option value="329">MAN 341 Type E1</option>
                        
                        <option value="527">MAN 341 Type E2</option>
                        
                        <option value="362">MAN 341 Type E3</option>
                        
                        <option value="432">MAN 341 Type M3</option>
                        
                        <option value="232">MAN 341 Type N</option>
                        
                        <option value="430">MAN 341 Type TL</option>
                        
                        <option value="233">MAN 341 Type Z1</option>
                        
                        <option value="298">MAN 341 Type Z2</option>
                        
                        <option value="459">MAN 341 Type Z3</option>
                        
                        <option value="417">MAN 341 Type Z4</option>
                        
                        <option value="428">MAN 341-1 Type Z2</option>
                        
                        <option value="617">MAN 341Type Z5</option>
                        
                        <option value="335">MAN 342</option>
                        
                        <option value="781">MAN 342 Typ M1</option>
                        
                        <option value="782">MAN 342 Typ M2</option>
                        
                        <option value="778">MAN 342 Typ S1</option>
                        
                        <option value="777">MAN 342 Typ SL</option>
                        
                        <option value="234">MAN 342 Type M1</option>
                        
                        <option value="537">MAN 342 Type M2</option>
                        
                        <option value="526">MAN 342 Type M3</option>
                        
                        <option value="613">MAN 342 Type ML</option>
                        
                        <option value="235">MAN 342 Type N</option>
                        
                        <option value="331">MAN 342 Type S1</option>
                        
                        <option value="336">MAN 342 Type SL</option>
                        
                        <option value="130">MAN 3477</option>
                        
                        <option value="72">MAN 3575</option>
                        
                        <option value="165">MAN 3677</option>
                        
                        <option value="434">MAN M 3275</option>
                        
                        <option value="673">MAN M 3289</option>
                        
                        <option value="433">MAN M 3343 Type S</option>
                        
                        <option value="154">MAN M271</option>
                        
                        <option value="147">MAN M3271-1</option>
                        
                        <option value="91">MAN M3275</option>
                        
                        <option value="98">MAN M3275-1</option>
                        
                        <option value="84">MAN M3277</option>
                        
                        <option value="125">MAN M3277-CRT</option>
                        
                        <option value="110">MAN M3477</option>
                        
                        <option value="208">MAN M3575</option>
                        
                        <option value="363">MAN N 3343 S</option>
                        
                        <option value="625">Massey Ferguson CMS M 1143</option>
                        
                        <option value="626">Massey Ferguson CMS M 1145</option>
                        
                        <option value="314">Mazda ATF D-III</option>
                        
                        <option value="600">Mazda ATF FZ</option>
                        
                        <option value="767">Mazda FL22 Coolant</option>
                        
                        <option value="315">Mazda M-3</option>
                        
                        <option value="601">Mazda TFF CVT Fluid TC</option>
                        
                        <option value="32">MB 226.5</option>
                        
                        <option value="35">MB 226.51</option>
                        
                        <option value="167">MB 226.9</option>
                        
                        <option value="202">MB 227.0</option>
                        
                        <option value="101">MB 227.1</option>
                        
                        <option value="161">MB 228.0</option>
                        
                        <option value="85">MB 228.1</option>
                        
                        <option value="57">MB 228.3</option>
                        
                        <option value="73">MB 228.31</option>
                        
                        <option value="81">MB 228.5</option>
                        
                        <option value="111">MB 228.51</option>
                        
                        <option value="7">MB 229.1</option>
                        
                        <option value="16">MB 229.3</option>
                        
                        <option value="27">MB 229.31</option>
                        
                        <option value="20">MB 229.5</option>
                        
                        <option value="12">MB 229.51</option>
                        
                        <option value="152">MB 229.52</option>
                        
                        <option value="236">MB 235.0</option>
                        
                        <option value="237">MB 235.1</option>
                        
                        <option value="389">MB 235.10</option>
                        
                        <option value="460">MB 235.11</option>
                        
                        <option value="779">MB 235.20</option>
                        
                        <option value="177">MB 235.27</option>
                        
                        <option value="96">MB 235.28</option>
                        
                        <option value="435">MB 235.4</option>
                        
                        <option value="299">MB 235.5</option>
                        
                        <option value="614">MB 235.6</option>
                        
                        <option value="242">MB 235.61</option>
                        
                        <option value="517">MB 235.7</option>
                        
                        <option value="615">MB 235.72</option>
                        
                        <option value="332">MB 235.8</option>
                        
                        <option value="227">MB 236.1</option>
                        
                        <option value="369">MB 236.10</option>
                        
                        <option value="485">MB 236.11</option>
                        
                        <option value="370">MB 236.12</option>
                        
                        <option value="371">MB 236.14</option>
                        
                        <option value="419">MB 236.15</option>
                        
                        <option value="365">MB 236.2</option>
                        
                        <option value="377">MB 236.20</option>
                        
                        <option value="247">MB 236.21</option>
                        
                        <option value="414">MB 236.3</option>
                        
                        <option value="576">MB 236.41</option>
                        
                        <option value="228">MB 236.5</option>
                        
                        <option value="311">MB 236.6</option>
                        
                        <option value="328">MB 236.7</option>
                        
                        <option value="308">MB 236.8</option>
                        
                        <option value="356">MB 236.81</option>
                        
                        <option value="349">MB 236.9</option>
                        
                        <option value="531">MB 236.91</option>
                        
                        <option value="692">MB 325.0</option>
                        
                        <option value="746">MB 325.2</option>
                        
                        <option value="706">MB 325.3</option>
                        
                        <option value="756">MB 325.5</option>
                        
                        <option value="774">MB 326.3</option>
                        
                        <option value="678">MB 344.0</option>
                        
                        <option value="674">MB 345.0</option>
                        
                        <option value="598">MB A 001 989 77 03</option>
                        
                        <option value="599">MB A 001 989 78 03</option>
                        
                        <option value="565">Mercon</option>
                        
                        <option value="492">Mercon SP</option>
                        
                        <option value="538">MERCON-N2C-194A</option>
                        
                        <option value="448">MERCON® C</option>
                        
                        <option value="761">MEZ 121 C</option>
                        
                        <option value="524">MF 1139</option>
                        
                        <option value="525">MF 1144</option>
                        
                        <option value="501">MIL-2105D</option>
                        
                        <option value="402">MIL-L-2015EZF</option>
                        
                        <option value="102">MIL-L-2104D</option>
                        
                        <option value="156">MIL-L-2104E</option>
                        
                        <option value="238">MIL-L-2105</option>
                        
                        <option value="338">MIL-L-2105A</option>
                        
                        <option value="301">MIL-L-2105B</option>
                        
                        <option value="339">MIL-L-2105C</option>
                        
                        <option value="229">MIL-L-2105D</option>
                        
                        <option value="610">MIL-L-2105E</option>
                        
                        <option value="103">MIL-L-46152B</option>
                        
                        <option value="164">MIL-L-46152D</option>
                        
                        <option value="162">MIL-L-46152E</option>
                        
                        <option value="640">MIL-PRF-2105D</option>
                        
                        <option value="283">MIL-PRF-2105E</option>
                        
                        <option value="602">Mini Cooper CVT</option>
                        
                        <option value="647">MINI EZL799</option>
                        
                        <option value="655">Mitsubish J2</option>
                        
                        <option value="270">Mitsubishi CVTF-J1</option>
                        
                        <option value="648">Mitsubishi CVTF-S</option>
                        
                        <option value="659">Mitsubishi J3</option>
                        
                        <option value="522">Mitsubishi J4</option>
                        
                        <option value="476">Mitsubishi MZ320065</option>
                        
                        <option value="571">Mitsubishi S0001401</option>
                        
                        <option value="316">Mitsubishi SP-II</option>
                        
                        <option value="271">Mitsubishi SP-III</option>
                        
                        <option value="670">Mitsubishi SP-IV</option>
                        
                        <option value="425">Mitsubishi TC-SST</option>
                        
                        <option value="391">MOPAR ATF +3</option>
                        
                        <option value="392">MOPAR ATF +4</option>
                        
                        <option value="568">Mopar CVTF+4</option>
                        
                        <option value="575">MTF BOT 207</option>
                        
                        <option value="709">MTU MTL 5048</option>
                        
                        <option value="693">MTU MTL 5049</option>
                        
                        <option value="74">MTU Type 1</option>
                        
                        <option value="58">MTU Type 2</option>
                        
                        <option value="88">MTU Type 3</option>
                        
                        <option value="131">MTU Type 3.1</option>
                        
                        <option value="694">NATO S-759</option>
                        
                        <option value="739">Navistar B-1 typ 3</option>
                        
                        <option value="612">Navistar TMS 6816</option>
                        
                        <option value="627">New Holland NH 410B</option>
                        
                        <option value="748">NF R 15 601</option>
                        
                        <option value="539">Nissan ECVT</option>
                        
                        <option value="572">Nissan KLE5200002</option>
                        
                        <option value="573">Nissan KLE520000403</option>
                        
                        <option value="768">Nissan L250 Coolant</option>
                        
                        <option value="317">Nissan Matic-C</option>
                        
                        <option value="272">Nissan Matic-D</option>
                        
                        <option value="318">Nissan Matic-J</option>
                        
                        <option value="555">Nissan Matic-K</option>
                        
                        <option value="440">Nissan Matic-S</option>
                        
                        <option value="660">Nissan Matic-W</option>
                        
                        <option value="273">Nissan NS-1</option>
                        
                        <option value="274">Nissan NS-2</option>
                        
                        <option value="607">Nissan NS-3</option>
                        
                        <option value="146">NMMA FC-W</option>
                        
                        <option value="28">NMMA TC W III</option>
                        
                        <option value="185">NMMA TC-W</option>
                        
                        <option value="187">NMMA TC-W3 R-56623</option>
                        
                        <option value="189">NMMA TC-W3 RL93938K</option>
                        
                        <option value="169">NMMA TC-WII</option>
                        
                        <option value="754">Onorm V-5123</option>
                        
                        <option value="548">OPEL 19 40 766</option>
                        
                        <option value="710">Opel B0400240</option>
                        
                        <option value="757">Opel B0401065</option>
                        
                        <option value="758">Opel B401065</option>
                        
                        <option value="677">Pentosin CHF 11S</option>
                        
                        <option value="671">Peugeot B712710</option>
                        
                        <option value="93">Porsche</option>
                        
                        <option value="666">Porsche 000 043 304 00</option>
                        
                        <option value="559">Porsche 10 52 107</option>
                        
                        <option value="248">Porsche 999 917 080 00</option>
                        
                        <option value="486">PORSCHE 999 917 547 00</option>
                        
                        <option value="209">Porsche A30</option>
                        
                        <option value="33">PORSCHE A40</option>
                        
                        <option value="643">Porsche ATF 3403 M11</option>
                        
                        <option value="545">Porsche ATF LT 71141</option>
                        
                        <option value="29">PORSCHE C30</option>
                        
                        <option value="521">Porsche FFL-3</option>
                        
                        <option value="507">PSA 9730A2</option>
                        
                        <option value="508">PSA 9730A8</option>
                        
                        <option value="249">PSA 9734S2</option>
                        
                        <option value="574">PSA 9735EF</option>
                        
                        <option value="45">PSA B 71 2290</option>
                        
                        <option value="163">PSA B71 2294</option>
                        
                        <option value="158">PSA B71 2295</option>
                        
                        <option value="34">PSA B71 2296</option>
                        
                        <option value="180">PSA B71 2297</option>
                        
                        <option value="217">PSA B71 2300</option>
                        
                        <option value="222">PSA B71 2312</option>
                        
                        <option value="582">PSA B71 2315</option>
                        
                        <option value="443">PSA B71 2330</option>
                        
                        <option value="621">PSA B71 2375</option>
                        
                        <option value="312">PSA B71 2710</option>
                        
                        <option value="618">PSA S71 2710</option>
                        
                        <option value="749">Ready Mix -25°C</option>
                        
                        <option value="750">Ready Mix -30°C</option>
                        
                        <option value="398">Renault</option>
                        
                        <option value="397">Renault DP0</option>
                        
                        <option value="426">Renault EDC 6 speed</option>
                        
                        <option value="334">RENAULT JXX</option>
                        
                        <option value="333">Renault LKW</option>
                        
                        <option value="399">RENAULT NDX</option>
                        
                        <option value="401">RENAULT PXX</option>
                        
                        <option value="134">Renault RD</option>
                        
                        <option value="82">Renault RD-2</option>
                        
                        <option value="148">Renault RGD</option>
                        
                        <option value="97">Renault RLD</option>
                        
                        <option value="106">Renault RLD-2</option>
                        
                        <option value="75">Renault RLD-3</option>
                        
                        <option value="21">Renault RN 0700</option>
                        
                        <option value="17">Renault RN 0710</option>
                        
                        <option value="36">Renault RN 0720</option>
                        
                        <option value="92">Renault RVI</option>
                        
                        <option value="83">Renault RXD</option>
                        
                        <option value="219">Renault RXD-2</option>
                        
                        <option value="400">RENAULT TL4</option>
                        
                        <option value="747">Renault Type D</option>
                        
                        <option value="775">Renault VI</option>
                        
                        <option value="220">Renault VI RDL</option>
                        
                        <option value="172">Renault VI RLD-2</option>
                        
                        <option value="132">Renault VI RLD-3</option>
                        
                        <option value="560">Rolls Royce PL 31493PA</option>
                        
                        <option value="695">SAAB 6901599</option>
                        
                        <option value="112">Scania</option>
                        
                        <option value="212">SCANIA</option>
                        
                        <option value="89">Scania LDF</option>
                        
                        <option value="135">Scania LDF II</option>
                        
                        <option value="192">Scania LDF III</option>
                        
                        <option value="313">Scania STO 1</option>
                        
                        <option value="348">Scania STO 2</option>
                        
                        <option value="735">SCANIA TB 1451</option>
                        
                        <option value="649">SCION ATF WS</option>
                        
                        <option value="472">SHELL M-1375.4</option>
                        
                        <option value="346">Subaru ATF</option>
                        
                        <option value="603">Subaru i-CVTF</option>
                        
                        <option value="449">Subaru Lineartronic CVTF</option>
                        
                        <option value="450">Subaru NS-2</option>
                        
                        <option value="275">Suzuki CVT Green 1</option>
                        
                        <option value="276">Suzuki CVT green1 V</option>
                        
                        <option value="451">Suzuki NS-2</option>
                        
                        <option value="277">Suzuki S-CVT Oil</option>
                        
                        <option value="452">Suzuki TC</option>
                        
                        <option value="716">TMC of ATA RP-302A</option>
                        
                        <option value="740">TMC RP 302</option>
                        
                        <option value="741">TMC RP 329</option>
                        
                        <option value="738">TMC RP 338</option>
                        
                        <option value="742">TMC RP 351</option>
                        
                        <option value="458">Toyota D-2</option>
                        
                        <option value="530">Toyota JWS</option>
                        
                        <option value="385">Toyota JWS 3309</option>
                        
                        <option value="347">Toyota T</option>
                        
                        <option value="319">Toyota T-II</option>
                        
                        <option value="320">Toyota T-III</option>
                        
                        <option value="321">Toyota T-IV</option>
                        
                        <option value="278">Toyota TC</option>
                        
                        <option value="770">Toyota TSK 2601</option>
                        
                        <option value="441">Toyota WS</option>
                        
                        <option value="755">UNE 25-361</option>
                        
                        <option value="759">UNE 26361-88</option>
                        
                        <option value="760">US 6277 M</option>
                        
                        <option value="453">Voith 55.6336.32</option>
                        
                        <option value="554">Voith DIWA</option>
                        
                        <option value="309">Voith G1363</option>
                        
                        <option value="340">Voith G607</option>
                        
                        <option value="350">Voith H55.6335</option>
                        
                        <option value="395">Voith H55.6335.35</option>
                        
                        <option value="357">Voith H55.6336</option>
                        
                        <option value="533">Voith H55.6336.36</option>
                        
                        <option value="532">Voith H55.6336.38</option>
                        
                        <option value="589">Volvo 1161521</option>
                        
                        <option value="549">VOLVO 1161529</option>
                        
                        <option value="590">Volvo 1161621</option>
                        
                        <option value="250">Volvo 1161838</option>
                        
                        <option value="251">Volvo 1161839</option>
                        
                        <option value="715">Volvo 1286083</option>
                        
                        <option value="436">Volvo 97305</option>
                        
                        <option value="418">Volvo 97307</option>
                        
                        <option value="263">Volvo 97310</option>
                        
                        <option value="264">Volvo 97313</option>
                        
                        <option value="265">Volvo 97314</option>
                        
                        <option value="470">Volvo 97316</option>
                        
                        <option value="616">Volvo 97330</option>
                        
                        <option value="351">Volvo 97340</option>
                        
                        <option value="352">Volvo 97341</option>
                        
                        <option value="628">Volvo CE WB101</option>
                        
                        <option value="149">Volvo CNG</option>
                        
                        <option value="221">Volvo PKW</option>
                        
                        <option value="550">Volvo STD 1273.36</option>
                        
                        <option value="885">VOLVO VCC 95200377</option>
                        
                        <option value="121">VOLVO VCC RBSO-2AE</option>
                        
                        <option value="59">Volvo VDS</option>
                        
                        <option value="60">Volvo VDS-2</option>
                        
                        <option value="76">Volvo VDS-3</option>
                        
                        <option value="77">Volvo VDS-4</option>
                        
                        <option value="636">Volvo WB-101</option>
                        
                        <option value="8">VW 500.00</option>
                        
                        <option value="136">VW 501.00</option>
                        
                        <option value="80">VW 501.01</option>
                        
                        <option value="231">VW 501.50</option>
                        
                        <option value="358">VW 501.60</option>
                        
                        <option value="13">VW 502.00</option>
                        
                        <option value="22">VW 503.00</option>
                        
                        <option value="79">VW 503.01</option>
                        
                        <option value="30">VW 504.00</option>
                        
                        <option value="9">VW 505.00</option>
                        
                        <option value="14">VW 505.01</option>
                        
                        <option value="211">VW 505.02</option>
                        
                        <option value="23">VW 506.00</option>
                        
                        <option value="24">VW 506.01</option>
                        
                        <option value="31">VW 507.00</option>
                        
                        <option value="881">VW 508 00</option>
                        
                        <option value="882">VW 509 00</option>
                        
                        <option value="427">VW 6 speed FWD</option>
                        
                        <option value="551">VW G 002 000</option>
                        
                        <option value="552">VW G 004 000</option>
                        
                        <option value="509">VW G 009 317</option>
                        
                        <option value="534">VW G 052 025 A2</option>
                        
                        <option value="292">VW G 052 162</option>
                        
                        <option value="561">VW G 052 162 A1</option>
                        
                        <option value="562">VW G 052 162 A2</option>
                        
                        <option value="563">VW G 052 162 A6</option>
                        
                        <option value="510">VW G 052 171</option>
                        
                        <option value="406">VW G 052 171 A1</option>
                        
                        <option value="407">VW G 052 171 A2</option>
                        
                        <option value="511">VW G 052 178</option>
                        
                        <option value="408">VW G 052 178 A2</option>
                        
                        <option value="378">VW G 052 180</option>
                        
                        <option value="604">VW G 052 180 A1</option>
                        
                        <option value="577">VW G 052 180 A2</option>
                        
                        <option value="605">VW G 052 180 A6</option>
                        
                        <option value="252">VW G 052 182</option>
                        
                        <option value="379">VW G 052 190</option>
                        
                        <option value="594">VW G 052 196 A2</option>
                        
                        <option value="512">VW G 052 512</option>
                        
                        <option value="410">VW G 052 512 A2</option>
                        
                        <option value="591">VW G 052 515 A2</option>
                        
                        <option value="380">VW G 052 516</option>
                        
                        <option value="606">VW G 052 516 A2</option>
                        
                        <option value="513">VW G 052 527</option>
                        
                        <option value="253">VW G 052 529</option>
                        
                        <option value="514">VW G 052 532</option>
                        
                        <option value="592">VW G 052 533 A2</option>
                        
                        <option value="515">VW G 052 726</option>
                        
                        <option value="411">VW G 052 726 A2</option>
                        
                        <option value="516">VW G 052 798</option>
                        
                        <option value="359">VW G 052 911</option>
                        
                        <option value="293">VW G 052 990</option>
                        
                        <option value="493">VW G 055 005 A1</option>
                        
                        <option value="494">VW G 055 005 A2</option>
                        
                        <option value="495">VW G 055 005 A6</option>
                        
                        <option value="386">VW G 055 025 A2</option>
                        
                        <option value="381">VW G 055 190</option>
                        
                        <option value="650">VW G 055 540 A2</option>
                        
                        <option value="518">VW G 060 162</option>
                        
                        <option value="480">VW G 060 162 A1</option>
                        
                        <option value="481">VW G 060 162 A2</option>
                        
                        <option value="482">VW G 060 162 A6</option>
                        
                        <option value="412">VW G 060 726 A2</option>
                        
                        <option value="413">VW G 070 726 A2</option>
                        
                        <option value="546">VW LT 71141</option>
                        
                        <option value="553">VW TL 52146</option>
                        
                        <option value="487">VW TL 52162</option>
                        
                        <option value="644">VW TL 52171</option>
                        
                        <option value="645">VW TL 52178</option>
                        
                        <option value="638">VW TL 52180</option>
                        
                        <option value="383">VW TL 52182</option>
                        
                        <option value="646">VW TL 52512</option>
                        
                        <option value="266">VW TL 726</option>
                        
                        <option value="267">VW TL 727</option>
                        
                        <option value="682">VW TL-774C (G11)</option>
                        
                        <option value="683">VW TL-774D (G12)</option>
                        
                        <option value="711">VW TL-774F (G12+)</option>
                        
                        <option value="736">VW TL-774G (G12++)</option>
                        
                        <option value="751">VW TL-774J (G13)</option>
                        
                        <option value="883">VWTL525 77</option>
                        
                        <option value="884">WSS M2C950-A</option>
                        
                        <option value="588">ZF S671 090 312</option>
                        
                    </select>
                </div>

                <div class="catalog-oil__params-block">
                    <label class="catalog-oil__params-label">Объём л.</label>
                    <div class="catalog-oil__slider-range-wrapper jquery-ui">
                        <div class="catalog-oil__slider-output-wrapper">
                            <label class="catalog-oil__slider-output-label" for="slider-amount_min">от</label>
                            <input data-slide-value="0" class="ui-input catalog-oil__slider-output-input" name="volume_min" type="text" id="slider-amount_min">
                            <label class="catalog-oil__slider-output-label" for="slider-amount_max">до</label>
                            <input data-slide-value="250" class="ui-input catalog-oil__slider-output-input" name="volume_max" type="text" id="slider-amount_max">
                        </div>
                        <div class="catalog-oil__slider-range x-slider-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"><div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 0%; width: 100%;"></div><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"></span><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 100%;"></span></div>
                    </div>
                </div>

                <div class="catalog-oil__search-button-wrapper">
                    <a href="#" class="ui-button ui-button--green catalog-oil__search-button x-search-start">Начать поиск</a>
                </div>
            </div>
        </div>
</div>
		<div class="container">
			<div class="block-split__row row no-gutters">
				<div class="block-split__item block-split__item-sidebar col-auto">
					<div class="sidebar sidebar--offcanvas--mobile">
						<div class="sidebar__backdrop"></div>
						<div class="sidebar__body">
							<div class="sidebar__header">
								<div class="sidebar__title">{{ __('catalog.filters') }}</div>
								<button class="sidebar__close" type="button">
									<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12">
										<path d="M10.8,10.8L10.8,10.8c-0.4,0.4-1,0.4-1.4,0L6,7.4l-3.4,3.4c-0.4,0.4-1,0.4-1.4,0l0,0c-0.4-0.4-0.4-1,0-1.4L4.6,6L1.2,2.6c-0.4-0.4-0.4-1,0-1.4l0,0c0.4-0.4,1-0.4,1.4,0L6,4.6l3.4-3.4c0.4-0.4,1-0.4,1.4,0l0,0c0.4,0.4,0.4,1,0,1.4L7.4,6l3.4,3.4C11.2,9.8,11.2,10.4,10.8,10.8z"></path></svg>
								</button>
							</div>
							<div class="sidebar__content">
								<!---->
								@include('shop.filters.oilsfilter')
								<!---->
								@include('shop.block.randomproductswidget')
								<!---->
								@include('shop.block.lastestpost')
								<!---->
							</div>
						</div>
					</div>
				</div>
				<div class="block-split__item block-split__item-content col-auto">
					<div class="block">
						<div class="products-view">
							<!--products-list-->
							@include('shop.block.productsview')
							<!--products-list-->
						</div>
					</div>
				</div>
			</div>
			<div class="block-space block-space--layout--before-footer"></div>
		</div>
	</div>
</div>
<!-- site__body / end -->
@stop