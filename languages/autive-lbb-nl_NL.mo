��    M      �  g   �      �  =   �  6   �  6   �  /   5  C   e  6   �  6   �          0     7     H     `     t     �     �     �     �     �     �     �     	     	     #	  	   *	     4	     N	     ^	     f	     v	     �	     �	  )   �	  )   �	  .   �	  �   "
     �
  a   �
  ?        L     e       S   �     �  
   �     �  	   �  
   �       	             '  
   4     ?     N     _     n     }     �  !   �      �  ;   �  n     B   �  \   �  Y   .  ,   �  D   �  A   �  7   <  C   t  n   �  V   '  ^   ~  c   �     A     S  �  m  ;     5   W  7   �  4   �  C   �  8   >  B   w     �     �     �     �               (     7     D     Z     s     �     �     �  
   �     �  	   �     �     �  	   �               /     ?  0   H  .   y  /   �  �   �     d  s   k  F   �     &     <     S  X   Y     �  
   �     �  	   �  
   �     �  	   �     �       
          
   )     4     D     T     a      v  !   �  G   �  v     O   x  t   �  i   =  4   �  N   �  I   +  B   u  ?   �  u   �  b   n  n   �  u   @     �     �           I   2   !      C   ;       -   1          (      +           L   J                 %           /   4      .       '              5   <         D            0   E               >               ?       K           "       @   B                  G       :   7   F             *       ,   	   
       &   8   9      M   =      $   )      6   3   A          H   #                 $button_classes (string) the classes of the button, optional. $button_txt (string) the text of the button, optional. $price (int) the total price of the object, mandatory. $text (string) the text of the price, optional. $text_classes (string) the classes of the text container, optional. $text_deactivate (bool) deactivate the text, optional. A plugin to add the leaseboot.com button to a website. Activate dynamic pricing Autive Button alignment Button background color Button border color Button border radius Button border thickness Button classes Button font color Button font size Button font weight Button padding x Button padding y Button styling Button text Center Container Deactivate plugin styling Deactivate text Dynamic Dynamic pricing Example background Example price General Here you can change the dynamic settings. Here you can change the general settings. Here you can change the styling of the button. Here you can change the styling of the text. If you decide to not activate the styling make sure your theme does style the text. How to If you decide to deactivate the button styling make sure your theme does add the correct styling. If you disable the text the monthly price is not shown anymore. Lease Boot Button plugin Leaseboot Button Settings Left Make sure to add a # or . in this field to be able to target either an id or class. PHP PHP - HTML PHP - price PHP - url Price text Right Shortcode Text alignment Text classes Text color Text font size Text font weight Text padding x Text padding y Text styling The price of the boat The text of the button (optional) The text of the price (optional) Then you can use the following function to render the html: This will add Javascript to your website which will listen to changes to the price inside the given container. To do this make sure to enable Dynamic pricing on the Dynamic tab, We assume you use Dutch currency format (1.000,00) and will strip any non numerical content. When the price changes the button will be updated with the correct price, amount and url. You can use AJAX to make the button dynamic: You can use the following PHP code to get an instance of the button: You can use the following PHP code to only get the monthly price: You can use the following PHP code to only get the url: You can use the following attributes in order to change the button: You can use the shortcode [lease-boot-button] to add the button to your website with the following attributes: You can use {price} for the monthly price and {amount} for the total cost of the boat. You need to add variables in order, so if you only want to disable the text use the following. You need to set the Dynamic container in the Leaseboot plugin settings to make it work dynamically. https://autive.nl https://www.leaseboot.com Project-Id-Version: Lease Boot Button plugin
PO-Revision-Date: 2023-11-09 22:34+0100
Last-Translator: 
Language-Team: 
Language: nl
MIME-Version: 1.0
Content-Type: text/plain; charset=UTF-8
Content-Transfer-Encoding: 8bit
X-Generator: Poedit 3.4.1
X-Poedit-Basepath: ..
X-Poedit-Flags-xgettext: --add-comments=translators:
X-Poedit-WPHeader: lease-boot-button.php
X-Poedit-SourceCharset: UTF-8
X-Poedit-KeywordsList: __;_e;_n:1,2;_x:1,2c;_ex:1,2c;_nx:4c,1,2;esc_attr__;esc_attr_e;esc_attr_x:1,2c;esc_html__;esc_html_e;esc_html_x:1,2c;_n_noop:1,2;_nx_noop:3c,1,2;__ngettext_noop:1,2
X-Poedit-SearchPath-0: .
X-Poedit-SearchPathExcluded-0: *.min.js
X-Poedit-SearchPathExcluded-1: vendor
 $button_classes (string) de classes van de knop, optioneel. $button_txt (string) de tekst van de knop, optioneel. $price (int) de totale prijs van het object, verplicht. $text (tekenreeks) de tekst van de prijs, optioneel. $text_classes (string) de classes van de tekstcontainer, optioneel. $text_deactivate (bool) deactiveert de tekst, optioneel. Een plugin om de leaseboot.com knop aan een website toe te voegen. Dynamische prijzen activeren Autive Knoppen uitlijning Knop achtergrondkleur Knop randkleur Knop rand ronding Knop randdikte Knop classes Knop lettertype kleur ﻿Knop lettertype grote Knop lettertype dikte Knop padding x Knop padding y Knopstyling Knop tekst Midden Container Plugin-styling deactiveren Tekst deactiveren Dynamisch Dynamische prijzen Voorbeeld achtergrond Voorbeeld prijs Algemeen Hier kunt u de dynamische instellingen wijzigen. Hier kunt u de algemene instellingen wijzigen. Hier kunt u de vormgeving van de knop wijzigen. Hier kunt u de opmaak van de tekst wijzigen. Als u besluit de opmaak niet te activeren, zorg er dan voor dat uw thema de tekst wel opmaakt. How to Als u besluit om de styling van de knop uit te schakelen, zorg er dan voor dat uw thema de juiste styling toevoegt. Als u de tekst uitschakelt, wordt de maandprijs niet meer weergegeven. Leaseboot knop plugin Leaseboot instellingen Links Zorg ervoor dat u een # of . in dit veld toevoegt om een id of class te kunnen targeten. PHP PHP - HTML PHP - prijs PHP - url Prijstekst Rechts Shortcode Tekstuitlijning Tekst classes Tekstkleur Tekstgrootte Tekstdikte Tekst padding x Tekst padding y Tekst opmaak De prijs van de boot De tekst van de knop (optioneel) De tekst van de prijs (optioneel) Vervolgens kunt u de volgende functie gebruiken om de html te renderen: Hiermee voegt u Javascript aan uw website toe dat luistert naar wijzigingen in de prijs binnen de opgegeven container. Om dit te doen, moet u Dynamische prijzen inschakelen op het tabblad Dynamisch, Wij gaan ervan uit dat u het Nederlandse valutaformaat (1.000,00) gebruikt en alle niet numerieke inhoud verwijdert. Als de prijs verandert, wordt de knop bijgewerkt met de juiste prijs, het juiste bedrag en de juiste url. U kunt AJAX gebruiken om de knop dynamisch te maken: U kunt de volgende PHP-code gebruiken om een instantie van de knop te krijgen: U kunt de volgende PHP-code gebruiken om alleen de maandprijs te krijgen: U kunt de volgende PHP-code gebruiken om alleen de url te krijgen: U kunt de volgende attributen gebruiken om de knop te wijzigen: U kunt de shortcode [lease-boot-button] gebruiken om de knop aan uw website toe te voegen met de volgende attributen: U kunt {price} gebruiken voor de maandelijkse prijs en {amount} voor de totale kosten van de boot. U moet variabelen in volgorde toevoegen, dus als u alleen de tekst wilt uitschakelen, gebruikt u het volgende. U moet de Dynamische container instellen in de instellingen van de Leaseboot plugin om het dynamisch te laten werken. https://autive.nl https://www.leaseboot.com 