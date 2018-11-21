#1 Уншигч ном авах үед авсан номыг хадгалдаг reads нэртэй хүснэгт үүсгэ.
CREATE TABLE reads (
			reader_id   	VARCHAR(12) NOT NULL, 
			book_id   		VARCHAR(12) NOT NULL );

#2. Readers хүснэгтийн id талбарыг reads хүснэгтийн reader_id талбарт foreign key-р оноо. ON DELETE NO ACTION болгож өг.
ALTAR TABLE reads ADD FOREIGN KEY(reader_id) REFERENCES readers(id) ON DELETE NO ACTION;

#3.  Books хүснэгтийн id талбарыг reads хүснэгтийн book_id талбарт foreign key-р оноо. ON DELETE NO ACTION болгож өг.
ALTAR TABLE reads ADD FOREIGN KEY(book_id) REFERENCES books(id) ON DELETE NO ACTION;

#4. Уншигч хамгийн ихдээ таван ном зэрэг авч болох constraint тавь
CREATE DOMAIN, reader_id AS CHAR(5)
	CHECK(VALUE IN (SELECT reader_id FROM reads));

#5. Хаягдсан картын мэдээллийг устгах бөгөөд устгах үед бүртгэлтэй байгаа уншигчийн card_id талбар NULL утгатай болно.
ALTAR TABLE readers ADD FOREIGN KEY(card_id) REFERENCES cards(id) ON DELETE SET NULL;
