<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CampsiteModel;
use App\Models\BookingModel;
use App\Models\PaymentModel;
use CodeIgniter\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Get statistics data
        $userModel = new UserModel();
        $campsiteModel = new CampsiteModel();
        $bookingModel = new BookingModel();
        $paymentModel = new PaymentModel();

        // Calculate monthly revenue
        $currentMonth = date("Y-m");
        $monthlyRevenue = $paymentModel
            ->select("SUM(amount) as total_revenue")
            ->where("payment_status", "completed")
            ->where("created_at >=", $currentMonth . "-01")
            ->where("created_at <=", $currentMonth . "-31")
            ->first();

        $data = [
            "userCount" => $userModel->countAllResults(),
            "campsiteCount" => $campsiteModel->countAllResults(),
            "activeBookings" => $bookingModel
                ->where("status", "confirmed")
                ->countAllResults(),
            "monthlyRevenue" => $monthlyRevenue["total_revenue"] ?? 0,
        ];

        // Get recent activities
        $data["recentBookings"] = $this->getRecentBookings();
        $data["recentUsers"] = $this->getRecentUsers();
        $data["recentPayments"] = $this->getRecentPayments();

        return view("admin/dashboard", $data);
    }

    public function campsites()
    {
        $campsiteModel = new CampsiteModel();
        $data["campsites"] = $campsiteModel->findAll();

        return view("admin/campsites", $data);
    }

    public function addCampsite()
    {
        if ($this->request->getMethod() === "post") {
            $campsiteModel = new CampsiteModel();

            $rules = [
                "name" => "required|min_length[3]|max_length[255]",
                "location" => "required",
                "price_per_night" => "required|numeric",
                "capacity" => "required|integer",
            ];

            if ($this->validate($rules)) {
                // Handle image upload if any
                $image = $this->request->getFile("image");
                $imageName = null;

                if ($image && $image->isValid() && !$image->hasMoved()) {
                    $newName = $image->getRandomName();
                    $image->move(
                        ROOTPATH . "public/uploads/campsites",
                        $newName
                    );
                    $imageName = $newName;
                }

                $data = [
                    "name" => $this->request->getPost("name"),
                    "description" => $this->request->getPost("description"),
                    "location" => $this->request->getPost("location"),
                    "price_per_night" => $this->request->getPost(
                        "price_per_night"
                    ),
                    "capacity" => $this->request->getPost("capacity"),
                    "facilities" => $this->request->getPost("facilities"),
                    "image" => $imageName,
                ];

                $campsiteModel->save($data);
                return redirect()
                    ->to("/admin/campsites")
                    ->with("success", "Lokasi perkemahan berhasil ditambahkan");
            } else {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with("errors", $this->validator->getErrors());
            }
        }

        return view("admin/add_campsite");
    }

    public function editCampsite($id)
    {
        $campsiteModel = new CampsiteModel();
        $data["campsite"] = $campsiteModel->find($id);

        if (empty($data["campsite"])) {
            return redirect()
                ->to("/admin/campsites")
                ->with("error", "Lokasi perkemahan tidak ditemukan");
        }

        if ($this->request->getMethod() === "post") {
            $rules = [
                "name" => "required|min_length[3]|max_length[255]",
                "location" => "required",
                "price_per_night" => "required|numeric",
                "capacity" => "required|integer",
            ];

            if ($this->validate($rules)) {
                // Handle image upload if any
                $image = $this->request->getFile("image");
                $imageName = $data["campsite"]["image"]; // Keep existing image by default

                if ($image && $image->isValid() && !$image->hasMoved()) {
                    $newName = $image->getRandomName();
                    $image->move(
                        ROOTPATH . "public/uploads/campsites",
                        $newName
                    );
                    $imageName = $newName;
                }

                $updateData = [
                    "id" => $id,
                    "name" => $this->request->getPost("name"),
                    "description" => $this->request->getPost("description"),
                    "location" => $this->request->getPost("location"),
                    "price_per_night" => $this->request->getPost(
                        "price_per_night"
                    ),
                    "capacity" => $this->request->getPost("capacity"),
                    "facilities" => $this->request->getPost("facilities"),
                    "image" => $imageName,
                ];

                $campsiteModel->save($updateData);
                return redirect()
                    ->to("/admin/campsites")
                    ->with("success", "Lokasi perkemahan berhasil diperbarui");
            } else {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with("errors", $this->validator->getErrors());
            }
        }

        return view("admin/edit_campsite", $data);
    }

    public function deleteCampsite($id)
    {
        $campsiteModel = new CampsiteModel();
        $campsite = $campsiteModel->find($id);

        if (empty($campsite)) {
            return redirect()
                ->to("/admin/campsites")
                ->with("error", "Lokasi perkemahan tidak ditemukan");
        }

        // Check for existing bookings
        $bookingModel = new BookingModel();
        $existingBookings = $bookingModel
            ->where("campsite_id", $id)
            ->countAllResults();

        if ($existingBookings > 0) {
            return redirect()
                ->to("/admin/campsites")
                ->with(
                    "error",
                    "Tidak dapat menghapus lokasi ini karena memiliki pemesanan aktif"
                );
        }

        // Delete the image if exists
        if (!empty($campsite["image"])) {
            $imagePath =
                ROOTPATH . "public/uploads/campsites/" . $campsite["image"];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $campsiteModel->delete($id);
        return redirect()
            ->to("/admin/campsites")
            ->with("success", "Lokasi perkemahan berhasil dihapus");
    }

    public function bookings()
    {
        $bookingModel = new BookingModel();

        // Get all bookings with campsite and user details
        $data["bookings"] = $bookingModel
            ->select(
                '
            bookings.*,
            campsites.name as campsite_name,
            campsites.location,
            users.username,
            users.email
        '
            )
            ->join("campsites", "campsites.id = bookings.campsite_id")
            ->join("users", "users.id = bookings.user_id")
            ->orderBy("bookings.created_at", "DESC")
            ->findAll();

        return view("admin/bookings", $data);
    }

    public function updateBookingStatus($id)
    {
        $bookingModel = new BookingModel();
        $booking = $bookingModel->find($id);

        if (empty($booking)) {
            return redirect()
                ->to("/admin/bookings")
                ->with("error", "Pemesanan tidak ditemukan");
        }

        $status = $this->request->getPost("status");
        $validStatuses = ["pending", "confirmed", "cancelled", "completed"];

        if (!in_array($status, $validStatuses)) {
            return redirect()
                ->to("/admin/bookings")
                ->with("error", "Status tidak valid");
        }

        $bookingModel->update($id, ["status" => $status]);
        return redirect()
            ->to("/admin/bookings")
            ->with("success", "Status pemesanan berhasil diperbarui");
    }

    public function payments()
    {
        $paymentModel = new PaymentModel();
        // Fetch all payments by calling getPaymentWithDetails without an ID
        $data["payments"] = $paymentModel->getPaymentWithDetails();

        return view("admin/payments", $data);
    }

    public function updatePaymentStatus($id)
    {
        $paymentModel = new PaymentModel();
        $payment = $paymentModel->find($id);

        if (empty($payment)) {
            return redirect()
                ->to("/admin/payments")
                ->with("error", "Pembayaran tidak ditemukan");
        }

        $status = $this->request->getPost("status");
        $validStatuses = ["pending", "completed", "failed", "refunded"];

        if (!in_array($status, $validStatuses)) {
            return redirect()
                ->to("/admin/payments")
                ->with("error", "Status tidak valid");
        }

        $paymentModel->update($id, [
            "payment_status" => $status,
            "notes" => $this->request->getPost("notes"),
        ]);

        // If payment is completed, update booking status to confirmed
        if ($status === "completed") {
            $bookingModel = new BookingModel();
            $bookingModel->update($payment["booking_id"], [
                "status" => "confirmed",
            ]);
        }

        return redirect()
            ->to("/admin/payments")
            ->with("success", "Status pembayaran berhasil diperbarui");
    }

    public function users()
    {
        $userModel = new UserModel();
        $data["users"] = $userModel->findAll();

        return view("admin/users", $data);
    }

    public function reports()
    {
        $bookingModel = new BookingModel();
        $paymentModel = new PaymentModel();

        // Get monthly booking stats for the current year
        $currentYear = date("Y");
        $data["bookingStats"] = $this->getMonthlyBookingStats($currentYear);

        // Get revenue stats
        $data["revenueStats"] = $this->getRevenueStats();

        // Get top campsites
        $data["topCampsites"] = $this->getTopCampsites();

        return view("admin/reports", $data);
    }

    private function getRecentBookings($limit = 5)
    {
        $bookingModel = new BookingModel();
        return $bookingModel
            ->select(
                '
            bookings.*,
            campsites.name as campsite_name,
            users.username
        '
            )
            ->join("campsites", "campsites.id = bookings.campsite_id")
            ->join("users", "users.id = bookings.user_id")
            ->orderBy("bookings.created_at", "DESC")
            ->limit($limit)
            ->find();
    }

    private function getRecentUsers($limit = 5)
    {
        $userModel = new UserModel();
        return $userModel->orderBy("created_at", "DESC")->limit($limit)->find();
    }

    private function getRecentPayments($limit = 5)
    {
        $paymentModel = new PaymentModel();
        return $paymentModel
            ->select(
                '
            payments.*,
            bookings.user_id,
            campsites.name as campsite_name,
            users.username
        '
            )
            ->join("bookings", "bookings.id = payments.booking_id")
            ->join("campsites", "campsites.id = bookings.campsite_id")
            ->join("users", "users.id = bookings.user_id")
            ->orderBy("payments.created_at", "DESC")
            ->limit($limit)
            ->find();
    }

    private function getMonthlyBookingStats($year)
    {
        $bookingModel = new BookingModel();
        $months = [];

        for ($i = 1; $i <= 12; $i++) {
            $month = str_pad($i, 2, "0", STR_PAD_LEFT);
            $startDate = "$year-$month-01";
            $endDate = date("Y-m-t", strtotime($startDate));

            $count = $bookingModel
                ->where("created_at >=", $startDate)
                ->where("created_at <=", $endDate)
                ->countAllResults();

            $months[] = $count;
        }

        return $months;
    }

    private function getRevenueStats()
    {
        $paymentModel = new PaymentModel();
        $currentYear = date("Y");
        $months = [];

        for ($i = 1; $i <= 12; $i++) {
            $month = str_pad($i, 2, "0", STR_PAD_LEFT);
            $startDate = "$currentYear-$month-01";
            $endDate = date("Y-m-t", strtotime($startDate));

            $result = $paymentModel
                ->selectSum("amount")
                ->where("payment_status", "completed")
                ->where("created_at >=", $startDate)
                ->where("created_at <=", $endDate)
                ->first();

            $months[] = $result["amount"] ?? 0;
        }

        return $months;
    }

    private function getTopCampsites($limit = 5)
    {
        $bookingModel = new BookingModel();
        return $bookingModel
            ->select(
                '
            campsites.id, campsites.name, campsites.location,
            COUNT(bookings.id) as booking_count,
            SUM(bookings.total_price) as total_revenue
        '
            )
            ->join("campsites", "campsites.id = bookings.campsite_id")
            ->where("bookings.status !=", "cancelled")
            ->groupBy("campsites.id")
            ->orderBy("booking_count", "DESC")
            ->limit($limit)
            ->find();
    }
}
