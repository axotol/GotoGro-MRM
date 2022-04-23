/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package entity;

import java.io.Serializable;
import javax.persistence.Basic;
import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.Id;
import javax.persistence.NamedQueries;
import javax.persistence.NamedQuery;
import javax.persistence.Table;
import javax.validation.constraints.NotNull;
import javax.validation.constraints.Size;
import javax.xml.bind.annotation.XmlRootElement;

/**
 *
 * @author Justin
 */
@Entity
@Table(name = "MYMEMBER")
@XmlRootElement
@NamedQueries({
    @NamedQuery(name = "Mymember.findAll", query = "SELECT m FROM Mymember m"),
    @NamedQuery(name = "Mymember.findByMemberid", query = "SELECT m FROM Mymember m WHERE m.memberid = :memberid"),
    @NamedQuery(name = "Mymember.findByName", query = "SELECT m FROM Mymember m WHERE m.name = :name"),
    @NamedQuery(name = "Mymember.findByPhonenumber", query = "SELECT m FROM Mymember m WHERE m.phonenumber = :phonenumber"),
    @NamedQuery(name = "Mymember.findByEmail", query = "SELECT m FROM Mymember m WHERE m.email = :email"),
    @NamedQuery(name = "Mymember.findByAddress", query = "SELECT m FROM Mymember m WHERE m.address = :address"),
    @NamedQuery(name = "Mymember.findByStatus", query = "SELECT m FROM Mymember m WHERE m.status = :status")})
public class Mymember implements Serializable {

    private static final long serialVersionUID = 1L;
    @Id
    @Basic(optional = false)
    @NotNull
    @Size(min = 1, max = 100)
    @Column(name = "MEMBERID")
    private String memberid;
    @Size(max = 100)
    @Column(name = "NAME")
    private String name;
    @Size(max = 100)
    @Column(name = "PHONENUMBER")
    private String phonenumber;
    // @Pattern(regexp="[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?", message="Invalid email")//if the field contains email address consider using this annotation to enforce field validation
    @Size(max = 100)
    @Column(name = "EMAIL")
    private String email;
    @Size(max = 100)
    @Column(name = "ADDRESS")
    private String address;
    @Size(max = 100)
    @Column(name = "STATUS")
    private String status;

    public Mymember() {
    }

    public Mymember(String memberid) {
        this.memberid = memberid;
    }

    public String getMemberid() {
        return memberid;
    }

    public void setMemberid(String memberid) {
        this.memberid = memberid;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getPhonenumber() {
        return phonenumber;
    }

    public void setPhonenumber(String phonenumber) {
        this.phonenumber = phonenumber;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getAddress() {
        return address;
    }

    public void setAddress(String address) {
        this.address = address;
    }

    public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }

    @Override
    public int hashCode() {
        int hash = 0;
        hash += (memberid != null ? memberid.hashCode() : 0);
        return hash;
    }

    @Override
    public boolean equals(Object object) {
        // TODO: Warning - this method won't work in the case the id fields are not set
        if (!(object instanceof Mymember)) {
            return false;
        }
        Mymember other = (Mymember) object;
        if ((this.memberid == null && other.memberid != null) || (this.memberid != null && !this.memberid.equals(other.memberid))) {
            return false;
        }
        return true;
    }

    @Override
    public String toString() {
        return "entity.Mymember[ memberid=" + memberid + " ]";
    }
    
}
