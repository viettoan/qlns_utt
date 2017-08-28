24/9/2015:
Mô tả công việc:
- Chức năng đăng nhập:
	Người dùng Admin đăng nhập vào hệ thống. Sau khi đăng nhập có thể tiến hành đổi mật khẩu hoặc thoát.
- Chức năng nhập thông tin cá nhân:
 + Mô tả:
	* Sau khi đăng nhập, người dùng chọn tab "Cập nhật thông tin cán bộ" trên thanh menu => chuyển đến giao diện cập nhật.
	* Người dùng có thể kéo nhập một lúc nhiều file excel để tiến hành nhập vào CSDL.
 + Công việc:
	* Code đăng nhập: Dùng cái đã có
	* Thiết kế CSDL: "Hai" - tối t5 xong.
	* Thiết kế file excel đầu vào: "Hai" - tối t6 up lên cho mọi người xem.
		o Một số thông tin như Tỉnh, Huyện, đơn vị trực thuộc, đơn vị cơ sở, danh hiệu, học hàm học vị phải để dạng combobox.
	* Code phần import file đầu vào: Dũng - bắt đầu từ t7
	* Thiết kế file excel xuất ra theo mẫu 2C: "Tài" - t6 up lên
	* Code phần xuất file theo mẫu 2C: "Hai, Dũng" - bắt đầu từ t3
	
 + Cách thiết kế project: Theo 2-tier:
	* Các lệnh truy vấn và hàm chức năng sẽ để ở thư mục BLL (Business Logic Layer) với tên: "BLL{tên chức năng}".
	* Giao diện hiển thị sẽ đăt ở thư mục PL (Presentation Layer) với tên dạng: "PL_{tên giao diện}".
	=> Nên đặt tên chuẩn mực để không gặp khó khăn trong quá trình maintain.
	* Thống nhất tên database là: "QLCBDoan" được đặt trong thư mục database.
	* Thư mục config chứa file config chứa code kết nối đến DB.
	* Thư mục css, js chứa các file css và javascript.
	* Thư mục excel chứa các file mẫu excel
	* Thư mục export chứa các file export tạm.