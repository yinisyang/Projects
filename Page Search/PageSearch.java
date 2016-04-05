import java.util.*;
import java.util.regex.Pattern;
import java.net.URL;
import java.net.URLConnection;
import java.net.MalformedURLException;
import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.io.IOException;
import java.io.File;

public class PageSearch {

   public static void main(String[] args) throws IOException, MalformedURLException{
      String id="", _class="", tag="", content="";
      
      int count = 0;
      while(count < args.length - 1){
         if(args[count].equals("-id")){
            id = args[count+1];
            count += 2;
         }else if(args[count].equals("-class")){
            _class = args[count+1];
            count += 2;
         }else if(args[count].equals("-tag")){
            tag = "<" + args[count+1] + ">";
            count += 2;
         }else if(args[count].equals("-content")){
            String temp = "";
            count++;
            while(count < args.length - 1 && args[count + 1].charAt(0) != '-'){
               temp += args[count] + " ";
               count++;
            }
            temp += args[count];
            count++;
            content = temp;
         }else
            throw new IllegalArgumentException("Illegal identifier: " + args[count]);
      }
      
      if(args[args.length - 1].contains("http://") || args[args.length - 1].contains("https://")){
         URL u = new URL(args[args.length - 1]);
         URLConnection uc = u.openConnection();
         BufferedReader in = new BufferedReader(new InputStreamReader(uc.getInputStream(), "UTF-8"));
         
         String line;
         while((line = in.readLine()) != null){
            if(line.contains("id\\s*=\\s*.*" + id + ".*")){ 
               System.out.println(line);
            }
         }
      }else{
         Scanner fin = new Scanner(new File(args[args.length - 1]));
         String line;
         while(fin.hasNext()){
            line = fin.nextLine();
            //System.out.println(line);
            if(line.contains("id\\s*=\\s*\"" + id + "\"", Pattern.UNICODE_CHARACTER_CLASS)){ 
               System.out.println(line);
            }
         }
      }
      
      System.out.println("id: " + id);
   }
}