<?php

class M_user extends CI_Model
{
    protected $table = 'user';
    /**
     * fungsi login user
     *
     * @param string $email    Alamat email yang sudah terdaftar
     * @param string $password password yang sah
     *
     * @return string pesan error atau berhasil
     */
    public function login(string $email, string $password): array
    {
        $return['text']  = 'User tidak terdaftar!';
        $return['class'] = 'danger';
        $q               = $this->db->get_where($this->table, ['email' => $email]);

        if ($q->num_rows() === 1) {
            $r = $q->result();

            if (password_verify($password, $r[0]->password)) {
                $return['text'] = 'Password salah!';

                if ($r[0]->status === '1') {
                    $data = [
                        'user_id'  => $r[0]->id_user,
                        'mail'     => $r[0]->email,
                        'username' => $r[0]->nama_user,
                        'role'     => $r[0]->id_role,
                        'loggedIn' => true,
                    ];
                    $this->session->set_userdata($data);
                    $return['text']  = 'Anda telah berhasil Login!';
                    $return['class'] = 'success';
                } else {
                    $return['text'] = 'Akun Anda belum aktif.';
                }
            }
            else {
                $return['text']  = 'Password salah!';
                $return['class'] = 'warning';
            }
        }

        return $return;
    }

    public function user($email)
    {
        $this->db->select('*');
        $this->db->from('user');
        // $this->db->join('role', 'role.id_role=user.id_role');
        $this->db->where('email', $email);

        return $this->db->get()->row_array();
    }

    public function ubhpsw($pswhash, $email)
    {
        $this->db->set('password', $pswhash);
        $this->db->set('ubah_password', time());
        $this->db->where('email', $email);
        $this->db->update('user');

        return $this->db;
    }

    public function insert($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function update($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}
