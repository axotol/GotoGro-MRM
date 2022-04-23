/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package session;

import entity.MyMemberDTO;
import entity.Mymember;
import javax.ejb.Stateless;
import javax.persistence.EntityManager;
import javax.persistence.PersistenceContext;
import javax.validation.ConstraintViolationException;

/**
 *
 * @author Justin
 */
@Stateless
public class MymemberFacade implements MymemberFacadeRemote {

    // Add business logic below. (Right-click in editor and choose
    // "Insert Code > Add Business Method")
    @PersistenceContext(unitName = "GOTO-DTO-ejbPU")
    private EntityManager em;

    protected EntityManager getEntityManager() {
        return em;
    }

    private void create(Mymember mymember) {
        em.persist(mymember);
    }

    private void edit(Mymember mymember) {
        em.merge(mymember);
    }

    private void remove(Mymember mymember) {
        em.remove(em.merge(mymember));
    }

    private Mymember find(Object id) {
        return em.find(Mymember.class, id);
    }

    @Override
    public boolean createMember(MyMemberDTO mymemberDTO) {
        if (find(mymemberDTO.getMemberid()) != null) {
            // user whose userid can be found 
            return false;
        }
// user whose userid could not be found
        try {
            Mymember mymember = this.myDTO2DAO(mymemberDTO);
            this.create(mymember); // add to database
            return true;
        } catch (Exception ex) {
            return false; // something is wrong, should not be here though
        }
    }
    

    private MyMemberDTO myDAO2DTO(Mymember mymember){
        return new MyMemberDTO(
            mymember.getMemberid(),
            mymember.getName(),
            mymember.getPhonenumber(),
            mymember.getEmail(),
            mymember.getAddress(),
            mymember.getStatus()
        );
    }
    
    private Mymember myDTO2DAO(MyMemberDTO mymemberDTO) {
        Mymember mymember = new Mymember();
        
        mymember.setMemberid(mymemberDTO.getMemberid());
        mymember.setName(mymemberDTO.getName());
        mymember.setPhonenumber(mymemberDTO.getPhoneNumber());
        mymember.setEmail(mymemberDTO.getEmail());
        mymember.setAddress(mymemberDTO.getAddress());
        mymember.setStatus(mymemberDTO.getStatus());
        
        return mymember;
    }

    @Override
    public MyMemberDTO getMember(String userId) {
        Mymember mymember = find(userId);
        if(mymember == null){
            return null;
        }
        return myDAO2DTO(mymember);
    }

    @Override
    public boolean updateMember(MyMemberDTO mymemberDTO) {
        if(getMember(mymemberDTO.getMemberid()) == null){
            return false;
        }
        Mymember mymember = myDTO2DAO(mymemberDTO);
        try{
            edit(mymember);
            return true;
        }catch(ConstraintViolationException e){
            return false;
        }catch(Exception ex){
            return false;
        }
    }

    @Override
    public boolean deleteMember(String userId) {
        MyMemberDTO mymemberDTO = getMember(userId);
        if(mymemberDTO == null){
            return false;
        }
        
        Mymember mymember = myDTO2DAO(mymemberDTO);
        try{
            remove(mymember);
            return true;
        }catch(Exception ex){
            return false;
        }
        
    } 
}
