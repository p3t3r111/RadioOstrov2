<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
  @vite(['resources/css/app.css','resources/js/app.js'])

  <title>@yield('title')</title>
</head>
<body class="min-h-screen">
  

  <div class="min-h-[90vh]" id="content">
    <section class="flex items-center justify-between gap-2 p-2">
      <a href="{{ route('index') }}"><img src="{{ asset('assets/logo.png') }}" id="logoHero" class="w-[32px]" alt="Logo školy : Stredná odborná škola informačných technológií, Ostrovského 1, Košice"></a>
      <div class="flex justify-center w-full">
        <h1 class="font-bold text-2xl">Informácie o spracúvaní osobných údajov</h1>
      </div>
    </section>
    <section class="flex flex-wrap gap-2 p-2 bg-ostrov sticky top-0 text-sm justify-center">
      <x-sec-nav-item href="#uvod" class="w-auto">Úvod</x-sec-nav-item>
      <x-sec-nav-item href="#zakladneustanovenia" class="w-min">I. Základné ustanovenia</x-sec-nav-item>
      <x-sec-nav-item href="#zakonnydovodspracovavaniaosobnychudajov" class="w-min">II. Zákonný dôvod spracovávania osobných údajov</x-sec-nav-item>
      <x-sec-nav-item href="#ucelspracovaniakategoriezdrojeaprijemcoviaosobnychudajov" class="w-min">III. Účel spracovávania, kategórie, zdroje a príjemcovia osobných údajov</x-sec-nav-item>
      <x-sec-nav-item href="#podmienkyposkytnutiasuhlasusospracuvanimosobnychudajov" class="w-min">IV. Podmienky poskytnutia súhlasu so spracúvaním osobných údajov</x-sec-nav-item>
      <x-sec-nav-item href="#dobauchovavaniaudajov" class="w-min">V. Doba uchovávania údajov</x-sec-nav-item>
      <x-sec-nav-item href="#vaseprava" class="w-min">VI. Vaše práva</x-sec-nav-item>
      <x-sec-nav-item href="#podmienkyzabezpeceniaosobnychudajov" class="w-min">VII. Podmienky zabezpečenia osobných údajov</x-sec-nav-item>
      <x-sec-nav-item href="#zaverecneustanovenia" class="w-min">VIII. Záverečné ustanovenia</x-sec-nav-item>
    </section>   
    <section class="flex flex-col gap-4 mx-10 my-4" id="">
      <div class="flex flex-col gap-4" id="uvod" name="uvod">
        <p>
          Ochrana fyzických osôb v súvislosti so spracúvaním osobných údajov patrí medzi základné práva. V článku 8 ods. 1 Charty základných práv Európskej únie a v článku 16 ods. 1 Zmluvy o fungovaní Európskej únie sa stanovuje, že každý má právo na ochranu osobných údajov, ktoré sa ho týkajú.
        </p>
        
        <p>
            Spracúvanie osobných údajov je zákonné, ak ich spracúvanie je nevyhnutné podľa osobitného predpisu; inak povedané, jedným z možných právnych základov pre spracúvanie osobných údajov je aj osobitný zákon. V prípade e-shopov je právnym základom na spracúvanie osobných údajov zákon č. 22/2004 Z. z. Zákon o elektronickom obchode a o zmene a doplnení zákona č. 128/2002 Z. z. o štátnej kontrole vnútorného trhu vo veciach ochrany spotrebiteľa a o zmene a doplnení niektorých zákonov v znení zákona č. 284/2002 Z. z. (v znení č. 160/2005 Z. z., 102/2014 Z. z., 373/2014 Z. z.), a ďalším právnym základom je súhlas dotknutej osoby.
        </p>
      </div>
      
      <p class="font-bold text-xl">SPRACOVÁVANIE OSOBNÝCH ÚDAJOV</p>
      
      <div>
        <p class="font-bold" id="zakladneustanovenia" name="zakladneustanovenia">I. Základné ustanovenia</p>
      
        <p>1. Prevádzkovateľom osobných údajov podľa čl. 4 bod 7 nariadenia Európskeho parlamentu a Rady (EU) 2016/679 o ochrane fyzických osôb v súvislosti so spracovávaním osobných údajov a o voľnom pohybu týchto údajov (ďalej len: „GDPR”) je internetový portál radio.ostrovskeho.sk.</p>
        <p>2. Osobnými údaji sa rozumejú všetky informácie o identifikovanej alebo identifikovateľnej fyzickej osobe; identifikovateľná fyzická osobou je fyzická osoba, ktorú je možné priamo alebo nepriamo identifikovať, najmä odkazom na určitý identifikátor, napríklad meno, identifikačné číslo, lokačné údaje, sieťový identifikátor alebo na jeden či viac zvláštnych prvkov fyzickej, fyziologickej, genetickej, psychickej, ekonomickej, kultúrnej alebo spoločenskej identity tejto fyzickej osoby.</p>
      </div>
      
      <div>
        <p class="font-bold" id="zakonnydovodspracovavaniaosobnychudajov" name="zakonnydovodspracovavaniaosobnychudajov">II. Zákonný dôvod spracovávania osobných údajov</p>
        <p>1. Zákonným dôvodom spracovávania osobných údajov je&nbsp;</p>
        <div class="ml-4">
          <p>plnenie zmluvy medzi Vami a prevádzkovateľom podľa čl. 6 odst. 1 písm. b) GDPR (ďale len “Plnenie zmluvy”),</p>
        <p>oprávnený záujem prevádzkovateľa na poskytovanie priameho marketingu (najmä pre zasielanie marketingových a obchodných informácií) podľa čl. 6 odst. 1 písm. f) GDPR (ďalej len “Oprávnený záujem”),</p>
        <p>Váš súhlas so spracovaním pre účely poskytovania priameho marketingu (najmä pre zasielanie marketingových a obchodných informácií ) podľa čl. 6 odst. 1 písm. a) GDPR v spojení s § 7 odst. 2 zákona č. 480/2004 Sb., o niektorých službách spoločnosti v prípade, že nedošlo k objednávke tovaru alebo služby (ďalej len “Súhlas”).</p>
        </div>
        <p>2. Zo strany prevádzkovateľa nedochádza k automatickému individuálnemu rozhodovaniu v zmysle čl. 22 GDPR. S takýmto spracovávaním ste poskytl/a svoj výslovný súhlas.</p>
      </div>
      
      <div>
        <p class="font-bold" id="ucelspracovaniakategoriezdrojeaprijemcoviaosobnychudajov" name="ucelspracovaniakategoriezdrojeaprijemcoviaosobnychudajov">III. Účel spracovávania, kategórie, zdroje a príjemcovia osobných údajov</p>
        <p>1. Prevádzkovateľ zároveň informuje, že v zmysle súhlasu dotknutej osoby má prevádzkovateľ právo získavať a spracovávať nasledujúce osobné údaje:,
        <p>2. Nevyhnutné: 1. e-mailová adresa, 2. IP adresa, 3. Meno, 4. Priezvisko.</p>
        <p>3. Prevádzkovateľ získané osobné údaje ďalej neposkytuje tretím osobám.</p>
      </div>
      
      <div>
        <p class="font-bold" id="podmienkyposkytnutiasuhlasusospracuvanimosobnychudajov" name="podmienkyposkytnutiasuhlasusospracuvanimosobnychudajov">IV. Podmienky poskytnutia súhlasu so spracúvaním osobných údajov</p>
        <p>1. Ak je spracovávanie osobných údajov založené na súhlase dotknutej osoby, prevádzkovateľ je povinný kedykoľvek vedieť preukázať, že dotknutá osoba poskytla súhlas so spracúvaním svojich osobných údajov.
        <p>2.Ak prevádzkovateľ žiada o udelenie súhlasu na spracovanie osobných údajov dotknutú osobu, tento súhlas musí byť odlíšený od iných skutočností a musí byť vyjadrený jasne a v zrozumiteľnej a ľahko dostupnej forme.</p>
        <p>3.Dotknutá osoba má právo kedykoľvek odvolať súhlas so spracovaním osobných údajov, ktoré sa jej týkajú. Odvolanie súhlasu nemá vplyv na zákonnosť spracúvania osobných údajov založenom na súhlase pred jeho odvolaním; pred poskytnutím súhlasu musí byť dotknutá osoba o tejto skutočnosti informovaná.</p>
        <p>4.Pri posudzovaní, či bol súhlas poskytnutý slobodne, sa najmä zohľadní skutočnosť, či sa plnenie zmluvy vrátane poskytnutia služby podmieňuje súhlasom so spracúvaním osobných údajov, ktorý nie je na plnenie tejto zmluvy nevyhnutný.</p>
        <p>5. Prevádzkovateľ zároveň informuje, že pri spracúvaní osobných údajov dotknutých osôb sa riadi zásadami:</p>
        <div class="ml-4">
          <p>Zásada zákonnosti - Osobné údaje možno spracúvať len zákonným spôsobom a tak, aby nedošlo k porušeniu základných práv dotknutej osoby.</p>
          <p>Zásada obmedzenia účelu - Osobné údaje sa môžu získavať len na konkrétne určený, výslovne uvedený a oprávnený účel a nesmú sa ďalej spracúvať spôsobom, ktorý nie je zlučiteľný s týmto účelom; ďalšie spracúvanie osobných údajov na účel archivácie, na vedecký účel, na účel historického výskumu alebo na štatistický účel, ak je v súlade s osobitným predpisom) a ak sú dodržané primerané záruky ochrany práv dotknutej osoby podľa § 78 ods. 8, sa nepovažuje za nezlučiteľné s pôvodným účelom.</p>
          <p>Zásada minimalizácie osobných údajov - Spracúvané osobné údaje musia byť primerané, relevantné a obmedzené na nevyhnutný rozsah daný účelom, na ktorý sa spracúvajú.</p>
          <p>Zásada správnosti - Spracúvané osobné údaje musia byť správne a podľa potreby aktualizované; musia sa prijať primerané a účinné opatrenia na zabezpečenie toho, aby sa osobné údaje, ktoré sú nesprávne z hľadiska účelov, na ktoré sa spracúvajú, bez zbytočného odkladu vymazali alebo opravili.</p>
          <p>Zásada minimalizácie uchovávania  - Osobné údaje musia byť uchovávané vo forme, ktorá umožňuje identifikáciu dotknutej osoby najneskôr dovtedy, kým je to potrebné na účel, na ktorý sa osobné údaje spracúvajú; osobné údaje sa môžu uchovávať dlhšie, ak sa majú spracúvať výlučne na účel archivácie, na vedecký účel, na účel historického výskumu alebo na štatistický účel na základe osobitného predpisu,8) a ak sú dodržané primerané záruky ochrany práv dotknutej osoby podľa § 78 ods. 8.</p>
          <p>Zásada integrity a dôvernosti - Osobné údaje musia byť spracúvané spôsobom, ktorý prostredníctvom primeraných technických a organizačných opatrení zaručuje primeranú bezpečnosť osobných údajov vrátane ochrany pred neoprávneným spracúvaním osobných údajov, nezákonným spracúvaním osobných údajov, náhodnou stratou osobných údajov, výmazom osobných údajov alebo poškodením osobných údajov.</p>
          <p>Zásada zodpovednosti - Prevádzkovateľ je zodpovedný za nedodržiavanie základných zásad spracúvania osobných údajov, za súlad spracúvania osobných údajov so zásadami spracúvania osobných údajov a je povinný tento súlad so zásadami spracúvania osobných údajov na požiadanie úradu preukázať.</p>
        </div>
      </div>
      
      <div>
        <p class="font-bold" id="dobauchovavaniaudajov" name="dobauchovavaniaudajov">V. Doba uchovávania údajov</p>
        <p>1. Prevádzkovateľ uchováva osobné údaje&nbsp;</p>
        <p>&nbsp; &nbsp;- po dobu nevyhnutnú k výkonu práv a povinností vyplývajúcich zo zmluvného vzťahu medzi Vami a prevádzkovateľom a uplatňovanie nárokov z týchto zmluvných vzťahov (po dobu 10 rokov od ukončenia zmluvného vzťahu).</p>
        <p>&nbsp; &nbsp;- po dobu, než je odvolaný súhlas so spracovaním osobných údajov pre účely marketingu, ak sú osobné údaje spracovávané na základe súhlasu.</p>
        <p>2. Po uplynutí doby uchovávania osobných údajov prevádzkovateľ osobné údaje vymaže.</p>
      </div>
      
      <div>
        <div>
          <p class="font-bold" id="vaseprava" name="vaseprava">VI. Vaše práva</p>
          <p>1. Za podmienok stanovených v GDPR máte&nbsp;</p>
          <p>&nbsp; &nbsp;- právo na prístup k svojím osobným údajom podľa čl. 15 GDPR,</p>
          <p>&nbsp; &nbsp;- právo na opravu osobných údajov podľa čl. 16 GDPR, poprípade obmedzenie spracovania podľa čl. 18 GDPR,</p>
          <p>&nbsp; &nbsp;- právo na výmaz osobných údajov podľa čl. 17 GDPR,</p>
          <p>&nbsp; &nbsp;- právo vzniesť námietku proti spracovaniu podľa čl. 21 GDPR,</p>
          <p>&nbsp; &nbsp;- právo na prenositeľnosť údajov podľa čl. 20 GDPR,</p>
          <p>&nbsp; &nbsp;- právo odvolať súhlas so spracovaním písomne alebo elektronicky na adresu alebo email prevádzkovateľom uvedený na podstránke kontakt.</p>
        </div>
        
        <p>
        2. Ďalej máte právo podať sťažnosť na Úrade pre ochranu osobných údajov v prípade, že sa domnievate, že bolo porušené Vaše právo na ochranu osobných údajov.
        </p>
      </div>

      <div>
        <p class="font-bold" id="podmienkyzabezpeceniaosobnychudajov" name="podmienkyzabezpeceniaosobnychudajov">VII. Podmienky zabezpečenia osobných údajov</p>
        <p>1. Prevádzkovateľ prehlasuje, že prijal všetky vhodné technické a organizačné opatrenia k zabezpečenie a preukázanie toho, že spracovávanie osobných údajov sa vykonáva v súlade s predmetným zákonom.</p>
        <p>2. Prevádzkovateľ prijal technické opatrenia k zabezpečeniu datových úložisk a úložísk osobných údajov.</p>
        <p>3. Prevádzkovateľ prehlasuje, že k osobným údajom majú prístup iba ním poverené osoby.</p>
      </div>
      
      <div>
        <p class="font-bold" id="zaverecneustanovenia" name="zaverecneustanovenia">VIII. Záverečné ustanovenia</p>
        <p>1. Odoslaním objednávky z internetového objednávkového formulára potvrdzujete, že ste oboznámený/á s podmienkami ochrany osobných údajov a že je v celom rozsahu prijímate.</p>
        <p>2. S týmito podmienkami súhlasíte zaškrtnutím súhlasu prostredníctvom internetového formulára. Zaškrtnutím súhlasu potvrdzujete, že ste oboznámený/á s podmienkami ochrany osobných údajov a že ich v celom rozsahu prijímate.</p>
      </div>
    </section>
  </div>
  @include('includes.footer')
</body>
</html>