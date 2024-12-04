@extends('client.layouts.master')

@section('content')
    <div class="container mt-5">
        <div class="col-12">
            <h3>Chính sách đổi trả sản phẩm</h3>
        </div>
        <div class="col-12 mt-3">
            <h6>Chính sách đổi trả hàng khi mua hàng tại Elegant Home</h6>
            <p class="text-black">Nhằm mang lại sự thuận tiện và hài lòng cho khách hàng, Elegant Home có những chính sách phù hợp khi khách hàng có nhu cầu đổi/ trả sản phẩm. Chúng tôi hy vọng những sản phẩm khách hàng đã chọn là sản phẩm ưng ý nhất.</p>
            <p class="text-black">
                Việc đổi/ trả sản phẩm đi kèm theo các điều kiện cụ thể, Quý khách vui lòng tham khảo thông tin chi tiết bên dưới:
            </p>
        </div>
        <div class="col-12">
            <h4 class="text-warning">I. QUY ĐỊNH ĐỔI/ TRẢ HÀNG</h4>

            <h6>1. Các trường hợp được đổi/ trả hàng</h6>

            <h6 class="text-warning">1.1 - Hàng giao bị lỗi kĩ thuật:</h6>
            <p class="text-black">
                Sản phẩm chỉ được xem là lỗi kỹ thuật khi được xác nhận từ chính Trung tâm kỹ thuật hoặc Trung tâm bảo hành của sản phẩm.
            </p>
            <p class="text-black">
                Khi Quý khách gặp trục trặc với sản phẩm đặt mua tại ElegantHome.test, vui lòng thực hiện các bước sau đây:
                <ul>
                    <li><strong>Bước 1:</strong> Tự kiểm tra cách thức sử dụng sản phẩm, các thao tác được hướng dẫn trong “Sách hướng dẫn sử dụng” đi kèm với mỗi sản phẩm (nếu có).</li>
                    <li><strong>Bước 2:</strong> Quý khách liên hệ với trung tâm kỹ thuật/ bảo hành: HOTLINE 0382500462 nhấn phím 03 hoặc email: info@eleganthome.test.</li>
                    <li><strong>Bước 3:</strong> Trong vòng 07 ngày kể từ ngày nhận hàng, nếu Quý khách được xác nhận từ Trung tâm kỹ thuật hoặc Trung tâm bảo hành của sản phẩm rằng sản phẩm bị lỗi kỹ thuật, quý khách vui lòng truy cập ngay mục III (Hướng dẫn đổi trả hàng) để bắt đầu quy trình đổi trả hàng.</li>
                </ul>
            </p>
            <p class="text-black">
                Nếu không thể liên hệ với trung tâm kỹ thuật/ bảo hành của sản phẩm, hãy liên lạc ngay với ElegantHome.test qua HOTLINE: 0382500462.
            </p>
            <p class="text-black">
                <strong>Lưu ý:</strong> Để tiết kiệm thời gian, Quý khách vui lòng đọc kỹ hướng dẫn sử dụng hoặc liên hệ bộ phận hỗ trợ kỹ thuật của sản phẩm để đảm bảo sản phẩm đã được lắp ráp và vận hành đúng cách.
            </p>

            <h6 class="text-warning">1.2 - Hàng giao bị bể vỡ, sai nội dung hoặc thiếu:</h6>
            <p class="text-black">
                ElegantHome.test khuyến khích Quý khách kiểm tra tình trạng bên ngoài của thùng hàng và sản phẩm trước khi thanh toán. Nếu gặp trường hợp hàng bị bể vỡ, sai nội dung hoặc thiếu, vui lòng từ chối nhận hàng và/hoặc báo ngay cho bộ phận hỗ trợ khách hàng HOTLINE: 0382500462.
            </p>
            <p class="text-black">
                Trong trường hợp đã nhận hàng và sau đó phát hiện lỗi, Quý khách vui lòng chụp ảnh sản phẩm và gửi email tới info@eleganthome.test để chúng tôi có phương án xử lý kịp thời.
            </p>

            <h6>2. Danh mục miễn đổi/ trả:</h6>
            <ul>
                <li>Sản phẩm khuyến mãi (có giá giảm từ 10% trở lên so với giá gốc).</li>
                <li>Sản phẩm không có lỗi kỹ thuật.</li>
                <li>Các sản phẩm phụ kiện (chẳng hạn như đèn trang trí, gối, thảm trải sàn,...)</li>
            </ul>

            <h6>3. Điều kiện đổi hàng:</h6>
            <p class="text-black">
                Quý khách vui lòng đọc kỹ các quy định được nêu rõ trong Chính sách đổi trả hàng của chúng tôi để đảm bảo rằng sản phẩm yêu cầu đổi/ trả thỏa mãn các điều kiện sau:
                <ul>
                    <li>Sản phẩm được mua online hoặc tại hệ thống cửa hàng của ElegantHome.test.</li>
                    <li>Sản phẩm còn nguyên đóng gói và bao bì không bị rách, móp.</li>
                    <li>Tem bảo hành, hướng dẫn sử dụng và các quà tặng kèm theo (nếu có) phải còn nguyên vẹn.</li>
                    <li>Không có dấu hiệu đã qua sử dụng, bẩn, trầy xước, hoặc hư hỏng.</li>
                    <li>Chỉ áp dụng đổi trả nếu có hóa đơn mua hàng.</li>
                    <li>Mỗi đơn hàng chỉ được hỗ trợ đổi 1 lần.</li>
                </ul>
            </p>

            <h6>4. Thời gian đổi trả hàng:</h6>
            <p class="text-black">
                - Đối với khách hàng mua tại cửa hàng, thời gian đổi trả là từ 3-7 ngày.
                - Đối với khách hàng mua online, thời gian đổi trả là từ 3-7 ngày tính từ ngày nhận sản phẩm.
            </p>

            <h6>5. Chi phí đổi trả hàng:</h6>
            <p class="text-black">
                - Đối với các sản phẩm lỗi kỹ thuật, khách hàng sẽ được miễn phí đổi trả và giao hàng miễn phí.
                - Đối với các sản phẩm đổi trả do lý do chủ quan từ khách hàng, khách hàng sẽ chịu chi phí vận chuyển hai chiều.
            </p>
        </div>

        <div class="col-12 mt-4">
            <h4 class="text-warning">II. QUY ĐỊNH ĐỔI HÀNG VÀ HOÀN TIỀN</h4>
            <h6>1. Đổi sản phẩm mới:</h6>
            <p class="text-black">
                Hình thức này áp dụng khi sản phẩm bị lỗi do nhà sản xuất. Chúng tôi sẽ đổi lại cho Quý khách sản phẩm mới cùng mẫu mã (cùng mã sản phẩm, cùng kích thước, cùng nhãn hiệu).
                Nếu sản phẩm hết hàng, chúng tôi sẽ đổi cho Quý khách một sản phẩm khác cùng nhãn hiệu có giá trị tương đương.
            </p>

            <h6>2. Hoàn tiền:</h6>
            <p class="text-black">
                Hoàn tiền chỉ áp dụng đối với trường hợp sản phẩm lỗi không có sản phẩm thay thế. Việc hoàn tiền sẽ được thực hiện qua chuyển khoản ngân hàng theo thông tin tài khoản mà Quý khách cung cấp.
                <strong>Thời gian xử lý:</strong> Quá trình hoàn tiền sẽ diễn ra trong vòng 30 ngày kể từ ngày nhận được thông tin tài khoản của Quý khách.
            </p>
        </div>

        <div class="col-12 mt-4">
            <h4 class="text-warning">III. HƯỚNG DẪN ĐỔI TRẢ HÀNG HÓA</h4>
            <h6>Đối với khách hàng mua tại cửa hàng:</h6>
            <p class="text-black">
                Vui lòng liên hệ trực tiếp cửa hàng đã mua để đổi trả.
            </p>

            <h6>Đối với khách hàng mua hàng online:</h6>
            <p class="text-black">
                Vui lòng làm theo các bước dưới đây:
                <ul>
                    <li><strong>Bước 1:</strong> Kiểm tra điều kiện đổi trả hàng để đảm bảo sản phẩm thỏa mãn các điều kiện.</li>
                    <li><strong>Bước 2:</strong> Đăng ký yêu cầu đổi/ trả qua email: info@eleganthome.test.</li>
                    <li><strong>Bước 3:</strong> Đóng gói sản phẩm yêu cầu đổi/ trả cẩn thận và gửi kèm hóa đơn mua hàng.</li>
                    <li><strong>Bước 4:</strong> Gửi hàng về cho ElegantHome.test qua các dịch vụ vận chuyển.</li>
                    <li><strong>Bước 5:</strong> Sau khi nhận sản phẩm đổi trả, chúng tôi sẽ xử lý và thông báo kết quả trong vòng 05 - 07 ngày làm việc.</li>
                </ul>
            </p>
        </div>
    </div>
@endsection
