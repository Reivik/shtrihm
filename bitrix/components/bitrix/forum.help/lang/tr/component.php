<?
$MESS ['F_TITLE'] = "Yardım";
$MESS ['F_TITLE_NAV'] = "Yardım";
$MESS ['F_INDEX'] = "Forumlar";
$MESS ['F_NO_MODULE'] = "Forum modülü ayarlı değil";
$MESS ['F_CONTENT'] = "<div class='forum-bold'>Forumda nasıl konu oluşturabilirim?</div>
<br />Forum konu listesi penceresinde veya ilgili konuda ilgili butona ya da bağlantıya tıklayın. Mesaj göndermedne önce kayıt yaptırmanız gerekebilir.<br /><div class=\"forum-bold\">HTML Kullanabilir miyim?</div><br />Yöneticinin izin verip vermediğine bağlı. Kullanılmasına izin verilmiş ise, büyük olasılıkla, sadece bir kaç etiket çalışabilir. Bu işlem güvenlik amacıyla sorun oluşturabilecek etiketlerin kullanılmasını engellemek içindir. HTML açık iken herhangi bir mesajda yazarken kullanabilirsiniz.<br /><div class='forum-bold'>HTML açık ise mesaj metnini nasıl düzenleyebilirim?</div><br />Yönetici aşağıdaki etiketlere izin verebilir:<br />

	<table class='forum-main'>
		<tr><th><div class='forum-bold'>???</div></th>
			<th><div class='forum-bold'>Tanım</div></th>
			<th><div class='forum-bold'>Eşanlamlılar</div></th>
			<th><div class='forum-bold'>Not</div></th></tr>
		<tr>
			<td>&lt;a href='bağlantı'&gt;</td>
			<td>bağlantı</td><td>[URL]bağlantı[/URL]<br />[URL=bağlantı]</td>	
			<td> </td></tr><tr><td>&lt;b&gt;, &lt;u&gt;, &lt;i&gt;</td>
			<td>duruma göre kalın, altı çizili veya italik yazı</td>
			<td>[b], [u], [i]</td><td>her zaman ilgili kapatıcı etiket bulunmak zorundadır &lt;/b&gt;, &lt;/u&gt;, &lt;/i&gt;</td></tr>
		<tr><td>&lt;img src='adres'&gt;</td><td>resim</td>
			<td>[img]adres[/img]</td>
			<td>adres - herhangi bir sitedeki resme tam bağlantı yolu</td></tr>
		<tr>
			<td>&lt;ul&gt;, &lt;li&gt;</td><td>numaralandırılmamış listeler</td>
			<td>[ul], [li]</td><td> </td></tr><tr><td>&lt;quote&gt;</td>
			<td>alıntıyı vurgulamak için özel metin</td><td>[quote]</td>
			<td>her zaman ilgili kapatıcı etiket bulunmak zorundadır &lt;/quote&gt;</td></tr>
		<tr><td>&lt;code&gt;</td>
			<td>kodu belirtmek için özel metin</td>
			<td>[code]</td>
			<td>her zaman ilgili kapatıcı etiket bulunmak zorundadır &lt;/code&gt;</td></tr>
		<tr><td>&lt;font color=&gt;, &lt;font size=&gt;</td><td>yazı tipi boyutu ve renginin değiştirilmesi</td>
			<td>[color=renk], [size=boyut]</td><td>her zaman ilgili kapatıcı etiket bulunmak zorundadır &lt;/font&gt;</td></tr></table>
		<br /><div class=\"forum-bold\">Resim ekleyebilir miyim?</div><br />Şayet yönetici tarafındna izin veirlmişse mesaja resim ekleyebilirsiniz. Ancak şimdilik foruma resim ekleme imkanı bulunmamaktadır. 
		
		
		Serverde bulunan resme olan bağlantıyı belirtmelisiniz, örneğin: [img]http://www.bitrix.ru/images/logo_bitrix.gif[/img] ??? &lt;img src='http://www.bitrix.ru/images/logo_bitrix.gif'&gt;.<br /><div class=\"forum-bold\">Yüz ifadeleri nedir?</div><br />Yüz veya duygu ifadeleri - mimikleri ve duyguları yansıtmak için kullanılan küçük resimlerdir, örneğin :) mutluluk demek, :( ise, hüzün demek. Yüz ifadelerinin tam listesi mesaj formunda bulunabilir. Ancak bu ifadeleri fazla kullanmayınız: çünkü bu ifadeler mesajları kolayca okunmaz hale getirir ve dolayısıyla mesajınız moderatör tarafından yeniden düzenlemeye tabi tutulabilir ya da tamamen silinebilir .<br /><div class='forum-bold'>Neden kayıt yaptırmam gerekiyor?</div><br />Bunu yapma zorunluluğunuz yok. Herşey yöneticinin forumu nasıl ayarladığına bağlıdır: yani, mesaj yazmak için kayıt yaptırmanızın gerkip gerekmediği gibi.<br /><div class='forum-bold'>Ayarlarımı nasıl değiştirebilirim?</div><br />Tüm ayarlaırnız veri tabanında muhafaza edilir (şayet kayıtlı iseniz). Değiştirmek için Profil bölümüne girin (bağlantısı forumun üst kısmında bulunuyor). Burada tüm ayarlarınızı değiştirebilirsiniz. Profil bölümüne erişim ancak kayıt yaptırdıktan sonra mümkündür.<br />Kullanıcı profilideğiştirme sayfası 3 parçadan oluşur: forumda kayıt bilgilerinin, kişisel bilgilerin ve profilin değiştirilmesi.		<br /><img height=49 src='/bitrix/images/forum/help/prof_link1.gif' width=370 border=0 alt=''/><UL><LI>Kayıt bilgilerinin değiştirilmesi bölümü; ad, soyad, kullanıcı adı ve parola değiştirilmesi için kullanılır. </LI><LI>Kişisel bilgilerin değiştirilmesi bölümü; meslek, ICQ numarası, doğum tarihi, fotoğraf, yaşanılan yer ve diğre kişisel bilgilerin değiştirilmesi için kullanılır</LI><LI>Forumdaki pofilin değiştirilmesi bölümü, forumdaki takma adın değiştirilmesi amacıyla kullanılır yani;<UL><LI><i>İsmin gösterilmesi.</i> Mesaj yazanın adı olarak eğer boş bırakılmamışsa onun adı ve soyadı gösterilir. Boş olduğunda ise, yazarın kullanıcı adı gösterilir. Bu işaret doldurulmuş olup olmadıklarına bakmaksızın ad ve soyadın kullanımını yasaklar;</LI><LI><i>Açıklama</i> - mesaj yazarının açıklaması mesaj yazarının adının altına girilecektir. Açıklama olarak; «admin», «moderatör», «destek» vb kelimeleri içeren cümle ve ifadeler kullanılamaz. Bu kuralı ihlal edenlerin forum kayıtları uyarıda bulunmaksızın silinecektir;</LI><LI><i>İmza</i> - ilgili kullanıcının her mesajının altına yazılan otomatik imza. İmzalarda ilgili forumda izin verilen her türlü etiket kullanılabilir;</LI><LI><i>Avatar</i> - Mesaj sahibinin adının altında gözüken resim. Resim 10 kb'dan büyük boyutta ve 90x90 pikselden büyük çözünürlükte olmamalıdır.</LI></UL></LI></UL><br /><div class=forum-bold\">Yeni mesajları e-posta olarak almak istiyorum!</div><br />Hem tüm forumdaki hem de belirli bir konudaki yeni mesjaları almaya abone olabilirsiniz. Bunun için serverde kayıtlı olmanız gerekmektedir. Şayet bütün forumdaki yeni mesajlara abone olmak isterseniz, forum menüsünde bulunan «Abonelik» (Resimde 1 numara ile gösterilen) bağlantısını kullanabilirsiniz. Şayet belirli bir konudaki yeni mesajlara abone olmak isterseniz, ilgili konunun üst köşesinde bulunan «Abonelik» (Resimde 2 numara ile gösterilen) bağlantısını kullanabilirsiniz..<br /><IMG height=104 src=\"/bitrix/images/forum/help/subscr.gif\" width=400 border=0 alt=\"\"/><br /><br />Abonelikleri yönetmek için profil sayfanızda bulunan «Abonelik [değiştir]», bağlantısını kullanabilirsiniz.<br /><IMG src='/bitrix/images/forum/help/prof_form.gif' width=400 height=261 border=0 alt=''/>\"";
?>