import java.util.*;
import java.io.*;
import java.nio.file.Files;

public class FindAndReplace {
   
   public static void main(String[] args) throws IOException{ // pattern, replaceWith, fileName
      Scanner fin = new Scanner(new File(args[2]));
      String pattern = args[0], replaceWith = args[1];
      PrintStream fout = new PrintStream("temp.txt");
      
      String line;
      while(fin.hasNext()){
         line = fin.nextLine();
         System.out.println(line);
         line = line.replaceAll(pattern, replaceWith);
         System.out.println(line);
         fout.println(line);
      }
      
      File f = new File("temp.txt");
      fin = new Scanner(f);
      fout = new PrintStream(args[2]);
      while(fin.hasNext()){
         fout.println(fin.nextLine());
      }
      
      fin.close();
      fout.close();
      fout = null;
      System.gc();
      f.delete();
   }

}